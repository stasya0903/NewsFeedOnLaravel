<?php

namespace App\News;

use App\Resource;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

/**
 * @method static create(array $array)
 */
class News extends Model
{

    protected $fillable = ['title','text', 'image', 'isPrivate', 'category_id'];

    public function category (){
        return  $this->belongsTo(Category::class, 'category_id');
    }

    public function resource (){
        return  $this->belongsTo(Resource::class, 'resource_id');
    }
    public static function  rules(){
        $tableNameCategory = (new Category())->getTable();
        return[
            'title' => 'required|min:5',
            'text'=> 'sometimes|required|min:1',
            'image'=> 'image|size:5000' ,
            'isPrivate' => 'boolean',
            'category_id' => "exists:{$tableNameCategory},id"
        ];
    }
    public static function attributeNames(){
        return [
            'title' => 'Заголовок новости',
            'text' => 'Текст новости',
            'category_id' => "Категория новости",
            'image' => "Изображение",
            'isPrivate' => 'Приватность',
        ];
    }



}
