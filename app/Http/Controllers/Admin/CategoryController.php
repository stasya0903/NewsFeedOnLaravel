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
            'categories' => Category::all(),
        ]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod("post")) {
            $request->flash();
            $result = Category::create($request);
            if ($result) {
                return redirect()->route('admin.news.categories.index')->with(
                    'success', "Категория успешно добавлена");
            }
        }
        return view('admin.news.categories.create', [
        ]);
    }

    public function delete($itemId)
    {
        if (News::deleteNewsItem($itemId)) {
            return redirect()->route('admin.news.categories.index')->with(
                'success', "Категория успешно удалена");
        }
    }

    public function show($category)
    {
        $category = Category::where('slot', $category)->firstOrFail();

        return view('admin.news.categories.show', [
            'news' => News::getNewsByCategoryId($category->id),
            'category' => $category
        ]);
    }

}
