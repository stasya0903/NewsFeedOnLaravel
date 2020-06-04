<?php

namespace App\Http\Controllers\News;

use App\News\Category;
use Illuminate\Http\Request;
use App\News\News;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        return view('news.index', [
            'news' => News::query()
                ->inRandomOrder()
                ->paginate(6),
            'categories' => Category::all()
                ->keyBy('id'),
        ]);
    }

    public function show(News $news)
    {
        $newsToPromote = News::where('category_id', $news->category_id)
            ->inRandomOrder()
            ->take(3)
            ->get();
        $categoryToOffer = Category::all()->take(6);
        return view('news.one', [
            'news' => $news,
            'newsToPromote' => $newsToPromote->except([$news->id]),
            'resource' => $news->resource()->first(),
            'categories' => $categoryToOffer
        ]);
    }

}
