<?php


namespace App\Services;


use App\News\Category;
use App\News\News;
use Orchestra\Parser\Xml\Facade as XmlParser;

class XmlParserService
{

    public function saveNews($link)
    {
        $this->pushToDb($this->getData($link));
    }

    public function getData($source)
    {
        $xml = XmlParser::load($source);
        /* dd($xml);*/
        $data = $xml->parse([
            'news' => ['uses' => 'channel.item[guid,title,link,description,pubDate,enclosure::url,category]']
        ]);
        if (!$data) {
            return redirect(route('admin.news.index'))
                ->with("error", 'Ошибка загрузки данных');
        }
        return $data['news'];
    }

    public function pushToDb($data)
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
                ]);
                if (!$news->save()) {
                    return redirect(route('admin.news.index'))
                        ->with("error", 'Ошибка добавления данных');
                }

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
