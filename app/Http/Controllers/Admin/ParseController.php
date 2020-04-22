<?php

namespace App\Http\Controllers\Admin;

use App\News\Category;
use App\News\News;
use App\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParseController extends Controller
{
    /** TODO доделать отдельную таблицу для источников, добавление id источника, CRUD источника  */
    protected $sourses = [
        ['name' => 'lenta',
            'url' => 'http://img.lenta.ru/r/EX/import.rss',],
        ['name' => 'rumbler',
            'url' => 'https://www.vedomosti.ru/rss/issue'],
        ['name' => 'ej',
            'url' => 'http://www.ej.by/news/news.rss']
    ];

    public
    function index()
    {
        foreach ($this->sourses as $resource) {
            $this->pushToDb($this->getData($resource->xmlSrc), $resource->id);
        }

        return redirect(route('admin.news.index'))
            ->with("success", 'Данные успешно загружены');

    }

    public
    function getData($source)
    {
        $xml = XmlParser::load($source);

        /*     dd($xml);*/
        $data = $xml->parse([
            'news' => ['uses' => 'channel.item[guid,title,link,description,pubDate,enclosure::url,category]']
        ]);
        if (!$data) {
            return redirect(route('admin.news.index'))
                ->with("error", 'Ошибка загрузки данных');
        }
       /* dd($data);*/
        return $data['news'];
    }

    public
    function pushToDb($data, $resource_id)
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
                    'resource_id'=> $resource_id
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
        $category = Category::where('title', $categoryTitle)->get()->first();
        if (!$category) {
            $category = Category::create([
                'title' => $categoryTitle,
                'slug' => str_replace(' ', '_', $categoryTitle)
            ]);
            if (!$category->save()) {
                $category->id = 1;
            };
        }

        return $category->id;

    }
}
