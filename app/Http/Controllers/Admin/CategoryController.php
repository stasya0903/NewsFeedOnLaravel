<?php

namespace App\Http\Controllers\Admin;

use App\News\Category;
use App\News\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $rules = Category::rules();
        $rules['slug'] = $rules['slug'] . '|unique:categories,slug';
        $validatedData = $this->validate(   $request,
                                            Category::rules(),
                                            [],
                                            Category::attributeNames());
        $result = Category::create($validatedData);
        if ($result) {
            return redirect(route('admin.category.index'))->with("success", 'Категория успешно добавлена');
        } else {
            $request->flash();
            return redirect(route('admin.category.index'))->with("error", 'Ошибка сервера');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\News\Category $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Category $category)
    {
        $v = Validator::make(   $request->all(),
                                Category::rules(),
                                [],
                                Category::attributeNames()
        );
        if ($v->fails()) {
            return redirect(route('admin.category.index'))->withErrors($v, $category->slug);

        } else {
            $result = $category->update($v->getData());
            if ($result) {
                return redirect(route('admin.category.index'))->with("success", 'Категория успешно обновлена');
            } else {
                return redirect(route('admin.category.index'))->with("error", 'Ошибка сервера');
            }

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\News\Category $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public
    function destroy(Category $category)
    {
        $result = $category->delete();
        if ($result) {
            return redirect(route('admin.category.index'))->with("success", 'Категория успешно удалена');
        } else {
            return redirect(route('admin.category.index'))->with("error", 'Ошибка сервера');
        }
    }
}
