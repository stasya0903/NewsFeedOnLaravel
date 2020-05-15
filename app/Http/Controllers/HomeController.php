<?php

namespace App\Http\Controllers;

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
            ->latest()
            ->first();
        $hoursDifference = 0;
        $category = null;

        if ($news) {
            $hoursDifference = $this->getHoursDifference($news);
            $category = $news->category()->first();
        }
        return view('index', [
            'news' => $news,
            'category' => $category,
            'hoursAgo' => $hoursDifference
        ]);
    }

    private function getHoursDifference($news)
    {
        $now = new Carbon(now());
        $created = new Carbon ($news->created_at);
        return $now->diffInHours($created);
    }
}
