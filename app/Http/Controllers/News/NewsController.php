<?php

namespace App\Http\Controllers\News;

use App\News\Category;
use Illuminate\Http\Request;
use App\News\News;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index (){
        return view('news.index')->with('news', News::getNews());
    }
    public function showOne($id){
        return view('news.one')->with('news', News::getNewsId($id));
    }

}
