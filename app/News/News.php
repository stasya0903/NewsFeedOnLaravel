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

    public static function saveImg($request){
        $url = null;
        if ($request->file('image')) {
            $path = Storage::putFile('public/images', $request->file('image'));
            $url =  Storage::url($path);
        }
        return $url;
    }
}
