<?php

namespace App\News;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    private static $news = [
        1 => [
            'id' => 1,
            'title' => 'Новость 1',
            'text' => 'А у нас новость 1 и она очень хорошая!',
            'category_id'=> 1
        ],
        2 => [
            'id' => 2,
            'title' => 'Новость 2',
            'text' => 'ljljljlk',
            'category_id'=> 2
        ],
        3 => [
            'id' => 3,
            'title' => 'Новость 3',
            'text' => 'А тут плохие новости(((',
            'category_id'=> 3
        ],
        4 => [
            'id' => 4,
            'title' => 'Новость 4',
            'text' => 'А тут плохие новости((('
        ],
        5 => [
            'id' => 5,
            'title' => 'Новость 5',
            'text' => 'А у нас новость 1 и она очень хорошая!',
            'category_id'=>4
        ],
        6 => [
            'id' => 6,
            'title' => 'Новость 6',
            'text' => 'ljljljlk',
            'category_id'=> 3
        ],
        7 => [
            'id' => 7,
            'title' => 'Новость 7',
            'text' => 'А тут плохие новости(((',
            'category_id'=> 2
        ],
        8 => [
            'id' => 8,
            'title' => 'Новость 8',
            'text' => 'А тут плохие новости(((',
            'category_id'=> 1
        ],
    ];

    public static function getNews() {
        return static::$news;
    }

    public static function getNewsId($id) {
        foreach (static::$news as $news) {
            if ($news['id'] == $id) {
                return $news;
            }
        }
    }
}
