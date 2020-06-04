<?php

namespace App\Http\Controllers;

use App\News\Category;
use App\News\News;
use Carbon\Carbon;
use Cassandra\Date;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Data;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $news = News::query()
            ->where('image', '<>', null)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('index', [
            'news' => $news,
            'categories' => Category::all()->keyBy('id')
        ]);
    }


}
