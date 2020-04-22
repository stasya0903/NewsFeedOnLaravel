<?php

namespace App;

use App\News\News;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['title', 'link', 'description', 'image', 'xmlSrc'];

    public function news(){
        return $this->hasMany(News::class, 'category_id');
    }
}


