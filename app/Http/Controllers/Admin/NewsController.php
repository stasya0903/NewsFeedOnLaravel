<?php

namespace App\Http\Controllers\Admin;

use App\News\Category;
use App\News\News;
use App\News\NewsExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use NunoMaduro\Collision\Writer;

class NewsController extends Controller
{
    public function index()
    {
        return view('admin.news.index')->with('news', News::getNews());
    }

    public function create(Request $request)
    {
        if ($request->isMethod("post")) {
            $request->flash();
            $result = News::create($request->except('_token'));
            if ($result) {
                return redirect()->route('admin.news.index');
            }
        }
        return view('admin.news.create', [
            'categories' => Category::getCategories()
        ]);
    }

    public function show($id)
    {
        $newsItem = News::getNewsId($id);
        if (!$newsItem) {
            abort(404, "Извините такой новости нет");
        }
        return view('admin.news.one')->with('news', $newsItem);
    }

    public function download(Request $request)
    {
        if ($request->isMethod("post")) {

            $downloadRequest = $request->input('format');

            if ($downloadRequest) {
                return $this->$downloadRequest();
            }

        }
        return view('admin.news.download');
    }

    public function JSON()
    {
        return response()->json(News::getNews())
            ->header('Content-Disposition', 'attachment; filename = "json.txt"')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    }

    public function EXCEL()
    {
        $export = new NewsExport([
            News::getNews()
        ]);
        return Excel::download($export, 'news.xlsx');
    }


}
