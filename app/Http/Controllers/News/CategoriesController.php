<?php

namespace App\Http\Controllers\News;

use App\News\Category;
use App\News\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function showAll(){
        return view('categories')->with('category', Category::getCategories() );
    }

    public function showCategory($category){
        return view('oneCategory', ['news'=> News::getNewsByCategory($category),
            'category'=> $category]);
    }
}
