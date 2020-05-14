<?php

namespace App;

use App\News\News;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['title', 'link', 'description', 'image', 'xmlSrc'];

        public static function rules()
        {
        return [
            'xmlSrc' => ['required', 'url', 'unique:resources' ]
        ];
    }

    public static function instructions()
    {
        return [
            'xmlSrc.required' => 'введите url источника',
            'xmlSrc.unique'=> 'этот источник уже добавлен'
        ];
    }

    public
    function news()
    {
        return $this->hasMany(News::class, 'resource_id');
    }
}


