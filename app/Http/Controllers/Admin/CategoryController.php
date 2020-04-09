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

    public function edit()
    {
        return view('admin.news.categories.edit', [
            'news' => News::all(),
            'categories' => Category::all(),
        ]);

    }

    public function store()
    {
      Category::create([
           'title' => request()['title'],
           'slug' => request()['slug'],
       ]);
        return view('admin.news.categories.edit');
    }

    public function delete(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('admin.news.categories.edit')->with("success", 'Новость успешно удалена');
        } catch (\Exception $e) {
            return redirect()->route('admin.news.categories.edit')->with("success", 'Ошибка сервера');
        }
    }

    public function update(Category $category, Request $request)
    {
        $dataToUpdate = $request->except('_token');
        $category->update($dataToUpdate);
        return redirect(route('admin.news.categories.edit'))->with("success", 'Новость успешно обновлена');

    }

    public function show(Category $category)
    {
        return view('admin.news.categories.show', [
            'news' => News::all()->where('category_id', '=', $category->id),
            'category' => $category
        ]);
    }

}
