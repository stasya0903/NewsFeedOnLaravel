<?php

namespace App\News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model

{
    protected $fillable = ['title','slug'];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function news(){
        return $this->hasMany(News::class, 'category_id');
    }
    public static function  rules(){
        return[
            'title' => 'required|min:2|max:20',
            'slug'=> 'required|min:2|max:40|alpha',
        ];
    }
    public static function attributeNames(){
        return [
            'title' => 'название категории',
            'slug'=> 'слот',
        ];
    }

}
