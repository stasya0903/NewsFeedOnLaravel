<?php

namespace App\Http\Controllers\News;

use App\News\Category;
use Illuminate\Http\Request;
use App\News\News;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index (){
        return view('news.index', [
            'news'=> News::all(),
            'categories'=> Category::all()->keyBy('id')
        ]);
    }
    public function show(News $news){
        return view('news.one', [
            'news'=> $news,
            'category'=> $news->category()->first()
        ]);
    }

}
