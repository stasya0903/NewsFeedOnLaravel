<?php

namespace App\News;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class News extends Model
{

    protected $fillable = ['title','text', 'image', 'isPrivate'];

    public function category (){
        return  $this->belongsTo(Category::class, 'category_id');
    }



}
