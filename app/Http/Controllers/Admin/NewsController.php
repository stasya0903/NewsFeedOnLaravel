<?php

namespace App\Http\Controllers\Admin;

use App\News\Category;
use App\News\News;
use App\News\NewsExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('admin.news.edit', [
            'news' => News::query()->orderByDesc('created_at')->paginate(7),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('admin.news.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = News::create(
            [
                'title' => request()['title'],
                'text' => request()['text'],
                'image' => $this->saveImg($request),
                'isPrivate' => isset($request->isPrivate)
            ]);
        return redirect(route('admin.news'))
            ->with("success", 'Новость успешно добавлена');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\News\News $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return response()->view('admin.news.update', [
            'news' => $news,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\News\News $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $dataToUpdate = $request->except('_token');
        $news->update($dataToUpdate);
        return redirect(route('admin.news.index'))
            ->with("success", 'Новость успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\News\News $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        try {
            $news->delete();
            return redirect()->route('admin.news.index')->with("success", 'Новость успешно удалена');
        } catch (\Exception $e) {
            return redirect()->route('admin.news.index')->with("success", 'Ошибка сервера');

        }
    }

    /**
     * Save the file with image in the storage.
     * @param Request $request
     * @return string|null
     */

    protected function saveImg($request)
    {
        $url = null;
        if ($request->file('image')) {
            $path = Storage::putFile('public/images', $request->file('image'));
            $url = Storage::url($path);
        }
        return $url;
    }

    /**
     * show the page to upload news in two the files
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function export()
    {
        return view('admin.news.download');
    }

    /**
     * Generate respond with file format, requested by user
     * @param Request $request
     * @return mixed
     */

    public function exportRespond (Request $request)
    {
        $downloadRequest = $request->input('format');

        if ($downloadRequest) {
            return $this->$downloadRequest();
        }

    }

    /**
     * generate json file from the collection of News
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\JsonResponse
     */

    public function JSON()
    {
        return response()->json(News::all())
            ->header('Content-Disposition', 'attachment; filename = "json.txt"')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    }

    /**
     * generate Excel file from the collection of Excel
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */

    public function EXCEL()
    {
        return Excel::download(new NewsExport, 'news.xlsx');
    }
}
