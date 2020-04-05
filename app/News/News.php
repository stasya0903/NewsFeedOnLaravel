<?php

namespace App\News;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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

    public static function create($request)
    {
        $newsItem [] = [
            'title' =>$request->title,
            'text' => $request->text,
            'image'=> static::saveImg($request),
            'isPrivate' => isset($request->isPrivate)
        ];
       return DB::table('news')->insert($newsItem);
    }

    public static function deleteNewsItem($itemId)
    {
        return DB::table('news')->where('id', $itemId)->delete();

    }

    public static function saveImg($request){
        $url = null;
        if ($request->file('image')) {
            $path = Storage::putFile('public/images', $request->file('image'));
            $url =  Storage::url($path);
        }
        return $url;
    }
}
