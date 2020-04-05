<?php

namespace App\Http\Controllers\Admin;

use App\News\Category;
use App\News\News;
use App\News\NewsExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use NunoMaduro\Collision\Writer;

class NewsController extends Controller
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
                return redirect()->route('admin.news.index')->with("success", 'Новость успешно добавлена');
            }
        }
        return view('admin.news.create', [
            'categories' => Category::getCategories(),
        ]);
    }

    public function delete($itemId)
    {
       if (News::deleteNewsItem($itemId)) {
           return redirect()->route('admin.news.index')->with("success", 'Новость успешно добавлена');
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

    public function export(Request $request)
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
        return response()->json(DB::table('news')->get())
            ->header('Content-Disposition', 'attachment; filename = "json.txt"')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    }

    public function EXCEL()
    {
        return Excel::download(new NewsExport, 'news.xlsx');
    }


}
