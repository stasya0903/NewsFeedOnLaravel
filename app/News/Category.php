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

}
