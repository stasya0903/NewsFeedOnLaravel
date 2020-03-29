<?php

namespace App\News;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    private static $categories = [
        1 => [
            'id' => 1,
            'name'=> "sport"
        ],
        2 => [
            'id' => 2,
            'name'=> "politics"
        ],
        3 => [
            'id' => 3,
            'name'=> "financial"
        ],
        4 => [
            'id' => 4,
            'name'=> "health"
        ]
    ];

    public static function getCategories() {
        return static::$categories;
    }

    public static function getCategoryByName($name) {
        foreach (static::$categories as $category) {
            if ($category['name'] == $name) {
                return $category;
            }
        };
    }
}
