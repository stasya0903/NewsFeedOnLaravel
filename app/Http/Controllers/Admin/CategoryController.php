<?php

namespace App\Http\Controllers\Admin;

use App\News\Category;
use App\News\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('admin.news.categories.edit', [
            'news' => News::all(),
            'categories' => Category::all(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Category::create([
            'title' => $request['title'],
            'slug' => $request['slug'],
        ]);
        return redirect(route('admin.category.index'))->with("success", 'Категория успешно добавлена');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return redirect(route('admin.category.index'))->with("success", 'Категория успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('admin.category.index')->with("success", 'Категория успешно удалена');
        } catch (\Exception $e) {
            return redirect()->route('admin.category.index')->with("success", 'Ошибка сервера');
        }
    }
}
