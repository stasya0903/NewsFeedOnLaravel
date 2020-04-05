<?php

namespace App\Http\Controllers\Admin;

use App\News\Category;
use App\News\News;
use App\News\NewsExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.news.categories.index', [
            'categories' => Category::getCategories(),
        ]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod("post")) {
            $request->flash();
            $result = Category::create($request);
            if ($result) {
                return redirect()->route('admin.news.categories.index')->with('success',"Категория успешно добавлена");
            }
        }
        return view('admin.news.categories.create', [
        ]);
    }

    public function delete($itemId)
    {
        if (News::deleteNewsItem($itemId)){
            return redirect()->route('admin.news.categories.index')->with('success',"Категория успешно удалена");
        }
    }

    public function show($id)
    {
        $newsItem = DB::table('news')->find($id);
        if (!$newsItem) {
            abort(404, "Извините такой новости нет");
        }
        return view('admin.news.one')->with('news', $newsItem);
    }

    public function showOne($category){
        $category = Category::getCategoryByName($category);
        if(!$category){
            abort(404, "Извините такой Категории нет");
        }
        return view('admin.news.categories.show', [
            'news'=> News::getNewsByCategoryId($category->id),
            'category'=> $category
        ]);
    }

}
