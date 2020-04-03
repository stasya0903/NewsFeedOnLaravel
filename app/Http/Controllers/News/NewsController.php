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
    public function show($id){
        $newsItem = News::getNewsId($id);
        if(!$newsItem){
            abort(404, "Извините такой новости нет");
        }
        return view('news.one')->with('news', $newsItem);
    }

}
