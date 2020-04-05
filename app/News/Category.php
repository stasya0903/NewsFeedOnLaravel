<?php

namespace App\News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    public static function getCategories() {
        return DB::table('categories')->get();
    }

    public static function getCategoryByName($name) {
        foreach (Category::getCategories() as $category) {
            if ($category['slot'] == $name) {
                return $category;
            }
        };
    }

    public static function create(\Illuminate\Http\Request $request)
    {
        $newsItem [] = [
            'title' =>$request->title,
            'slot' => $request->slot,
        ];
        return DB::table('categories')->insert($newsItem);
    }
}
