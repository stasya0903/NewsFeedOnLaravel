<?php

namespace App\Http\Controllers\Admin;

use App\News\Category;
use App\News\News;
use App\News\NewsExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Queue;

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
            'news' => new News()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $result = News::create($this->validateData($request));
        if ($result) {
            return redirect(route('admin.news.index'))
                ->with("success", 'Новость успешно добавлена');
        }
        $request->flash();
        return redirect(route('admin.news.create'))
            ->with("error", 'Ошибка добавления новости');


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\News\News $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return response()->view('admin.news.create', [
            'news' => $news,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\News\News $news
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, News $news)
    {
        $result = $news->update($this->validateData($request));
        if ($result) {
            return redirect(route('admin.news.index'))
                ->with("success", 'Новость успешно обновлена');
        } else {
            $request->flash();
            return redirect(route('admin.news.create'))
                ->with("error", 'Ошибка обновления новости');
        }

    }

    /**
     * Remove the specified resource from storage.
     * @param \App\News\News $news
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */

    public function destroy(News $news)
    {
        if ($news->delete()) {
            return redirect()->route('admin.news.index')->with("success", 'Новость успешно удалена');
        }

        return redirect()->route('admin.news.index')->with("success", 'Ошибка сервера');

    }

    /**
     * Remove the old resources from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */

    public function destroyOld(Request $request)
    {
        $now = New Carbon(now());

        $time = $now->subDays($request->get('days_ago'))->toDateString();

        $result = News::query()->where('created_at', '<', $time)
                                ->delete();
        if($result){
            return redirect()->route('admin.resource.index')->with("success", 'Новости успешно удалены');
        }

        return redirect()->route('admin.resource.index')->with("error", 'Ошибка сервера. Попробуйте позже');
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
     * show the page to upload news in to the files
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

    public function exportRespond(Request $request)
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

    public function validateData($request)
    {
        return $this->validate($request, News::rules(), [], News::attributeNames());
    }
}
