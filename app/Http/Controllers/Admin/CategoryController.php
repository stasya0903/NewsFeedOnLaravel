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
        $news = DB::table('news')->get();
        return view('admin.news.index', [
            'categories' => Category::getCategories(),
            'news'=> $news
        ]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod("post")) {
            $request->flash();
            $result = News::create($request);
            if ($result) {
                return redirect()->route('admin.news.index');
            }
        }
        return view('admin.news.create', [
            'categories' => Category::getCategories()
        ]);
    }

    public function delete($itemId)
    {
        if (News::deleteNewsItem($itemId)){
            return view('admin.news.index', [
                'categories' => Category::getCategories(),
                'news'=> DB::table('news')->get()
            ]);
        } else {
            return view('admin.news.index', [
                'categories' => Category::getCategories(),
                'news'=> DB::table('news')->get()
            ]);
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

}
