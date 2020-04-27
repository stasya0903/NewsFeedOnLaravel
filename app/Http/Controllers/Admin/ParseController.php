<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\NewsParsing;
use App\News\Category;
use App\News\News;
use App\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParseController extends Controller
{
    public function index()
    {
        foreach (Resource::all() as $link) {
            //dd($link);
            NewsParsing::dispatch($link->xmlSrc);
        }

        return redirect(route('admin.news.index'))
            ->with("success", 'Данные успешно загружены');
    }

}
