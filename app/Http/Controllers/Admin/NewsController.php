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

    public function create()
    {
        return view('admin.news.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = News::create(
            [
                'title' => request()['title'],
                'text' => request()['text'],
                'image' => $this->saveImg($request),
                'isPrivate' => isset($request->isPrivate)
            ]);
        return redirect(route('admin.news.show', $data->id));
    }

    public function edit()
    {
        return view('admin.news.edit', [
            'news' => News::all(),
            'categories' => Category::all(),
        ]);

    }
    public function editOne(News $news)
    {
        return view('admin.news.update', [
            'news' => $news,
            'categories' => Category::all(),
        ]);

    }

    public function update(News $news, Request $request)
    {
        $dataToUpdate = $request->except('_token');
        $news->update($dataToUpdate);
        return redirect(route('admin.news.update', $news->id))->with("success", 'Новость успешно обновлена');

    }

    public function delete(News $news)
    {
        try {
            $news->delete();
            return redirect()->route('admin.news.edit')->with("success", 'Новость успешно удалена');
        } catch (\Exception $e) {
            return redirect()->route('admin.news.edit')->with("success", 'Ошибка сервера');

        }

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


    protected function saveImg($request){
        $url = null;
        if ($request->file('image')) {
            $path = Storage::putFile('public/images', $request->file('image'));
            $url =  Storage::url($path);
        }
        return $url;
    }


}
