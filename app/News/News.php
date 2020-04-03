<?php

namespace App\News;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    public static function getNews()
    {
        return $news = json_decode(Storage::get('news.json'), 1) ?? [];

    }

    public static function getNewsId($id)
    {
        $news = News::getNews();
        foreach ($news as $item) {
            if ($item['id'] == $id) {
                return $item;
            }
        }
        return [];
    }

    public static function getNewsByCategoryId($category_id)
    {
        return array_filter(News::getNews(), function ($element) use ($category_id) {
            return $element['category_id'] == $category_id;
        });
    }

    public static function create($newNewsItem)
    {
        $news = News::getNews();
        $lastElementKey = array_key_last($news) ?? 0;
        $newNewsItem['id'] = $lastElementKey + 1;
        array_push($news, $newNewsItem);
        return Storage::put('news.json', json_encode($news, JSON_PRETTY_PRINT));
    }

    public static function deleteNewsItem($itemId)
    {
        $news = News::getNews();
        $elementKey = array_search($itemId, array_column($news, 'id'));
        array_splice($news, $elementKey, 1);
        return Storage::put('news.json', json_encode($news, JSON_PRETTY_PRINT));

    }
}
