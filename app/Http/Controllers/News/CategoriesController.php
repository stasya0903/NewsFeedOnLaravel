<?php

namespace App\Http\Controllers\News;

use App\News\Category;
use App\News\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index(){
        return view('news.categories')->with('categories', Category::getCategories() );
    }

    public function showOne($category){
        $category = Category::getCategoryByName($category);
        return view('news.oneCategory', ['news'=> News::getNewsByCategoryId($category['id']),
            'category'=> $category]);
    }
}
