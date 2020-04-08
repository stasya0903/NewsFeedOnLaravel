<?php

namespace App\News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function create(\Illuminate\Http\Request $request)
    {
        $newsItem [] = [
            'title' => $request->title,
            'slot' => $request->slot,
        ];
        return DB::table('categories')->insert($newsItem);
    }
}
