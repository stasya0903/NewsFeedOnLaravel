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
        $this->pushToDb($this->getData($resource->xmlSrc), $resource->id);

    }

    public function getData($source)
    {
        $xml = XmlParser::load($source);
        /*dd($xml);*/
        $data = $xml->parse([
            'news' => ['uses' => 'channel.item[guid,title,link,description,pubDate,enclosure::url,category]']
        ]);
        if (!$data) {
            return redirect(route('admin.news.index'))
                ->with("error", 'Ошибка загрузки данных');
        }
        return $data['news'];
    }

    public function pushToDb($data, $resource_id)
    {
        foreach ($data as $items => $item) {
            $newsWithSameTitle = News::where('title', $item['title'])->get()->first();
            if (!$newsWithSameTitle) {
                $news = new News();
                $news->fill([
                    'title' => $item['title'],
                    'text' => $item['description'],
                    'created_at' => $item['pubDate'],
                    'category_id' => $this->getCategoryId($item['category']),
                    'image' => $item['enclosure::url'],
                    'guid' => $item['guid'],
                    'resource_id' => $resource_id
                ]);

                if (!$news->save()) {
                    return redirect(route('admin.news.index'))
                        ->with("error", 'Ошибка добавления данных');
                }
                session()->flash('success', Queue::size('parsing'));

            }
        }
    }

    private function getCategoryId($categoryTitle)
    {
        $category = Category::firstOrCreate([
            'title' => $categoryTitle,
            'slug' => str_replace(' ', '_', $categoryTitle)
        ]);
        return $category->id;
    }

}
