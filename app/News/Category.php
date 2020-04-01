<?php

namespace App\News;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    private static $categories = [
        1 => [
            'id' => 1,
            'slot'=> "sport",
            'title'=>"Спорт"
        ],
        2 => [
            'id' => 2,
            'slot'=> "politics",
            'title'=>"Политика"
        ],
        3 => [
            'id' => 3,
            'slot'=> "financial",
            'title'=>"Финансы"
        ],
        4 => [
            'id' => 4,
            'slot'=> "health",
            'title'=>"Здоровье"
        ]
    ];

    public static function getCategories() {
        return static::$categories;
    }

    public static function getCategoryByName($name) {
        foreach (static::$categories as $category) {
            if ($category['slot'] == $name) {
                return $category;
            }
        };
    }
}
