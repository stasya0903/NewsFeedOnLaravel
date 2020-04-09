<?php

namespace App\Http\Controllers\News;

use App\News\Category;
use App\News\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index(){
        return view('news.categories')->with('categories', Category::all() );
    }

    public function show(Category $category){
        return view('news.oneCategory', [
            'category'=>$category,
            'news'=> $category->news()->get()
        ]);
    }
}
