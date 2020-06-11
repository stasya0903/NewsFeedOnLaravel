<?php


namespace App\Services;


use App\Events\EventJobAdded;
use App\News\Category;
use App\News\News;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Log;
use Queue;
use Orchestra\Parser\Xml\Facade as XmlParser;

class XmlParserService
{

    public function saveNews($resource)
    {
        return $this->pushToDb($this->getData($resource->xmlSrc), $resource);

    }

    public function getData($source)
    {
        $xml = XmlParser::load($source);
        $data = $xml->parse([
            'news' => ['uses' => 'channel.item[guid,title,link,description,pubDate,enclosure::url,category]']
        ]);
        if (!$data || !$data['news']) {
            return redirect(route('admin.news.index'))
                ->with("error", 'Ошибка загрузки данных');
        }
        return $data['news'];
    }

    public function pushToDb($data, $resource)
    {
        foreach ($data as $items => $item) {
            $newsWithSameTitle = News::where('title', $item['title'])->get()->first();
            if (!$newsWithSameTitle) {
                $news = new News();
                $news->fill([
                    'title' => $item['title'] ?? 'Заголовок отсутсвует',
                    'text' => $item['description'] ?? ' ',
                    'created_at' => $item['pubDate'],
                    'category_id' => $this->getCategoryId($item['category'], $resource['title']),
                    'image' => $item['enclosure::url'],
                    'guid' => $item['guid'],
                    'resource_id' => $resource->id
                ]);

                $result = $news->save();
                if (!$result) {
                    return redirect(route('admin.news.index'))
                        ->with("error", 'Ошибка загрузки данных');
                }


            }

        }
        return true;
    }

    private function getCategoryId($categoryTitleByNews, $categoryTitleByResource)
    {
        $categoryTitle = $categoryTitleByNews ?? $categoryTitleByResource;
        $category = Category::firstOrCreate([
            'title' => $categoryTitle ?? 'Другое',
            'slug' => str_replace(' ', '_', $categoryTitle ?? 'Другое')
        ]);
        return $category->id;
    }

}
