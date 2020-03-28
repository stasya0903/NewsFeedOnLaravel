<?php

namespace App\Http\Controllers\News;

use App\News\Category;
use Illuminate\Http\Request;
use App\News\News;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index (){
        return view('news')->with('news', News::getNews());
    }
    public function showOne($id){
        return view('newsOne')->with('news', News::getNewsId($id));
    }
    public function showCategory($category){
        $categoryId = Category::getCategoryId($category);
        return view('oneCategory', ['news'=> News::getNewsByCategory($categoryId),
                                            'category'=> $category]);
    }
}
