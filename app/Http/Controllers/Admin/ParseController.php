<?php

namespace App\Http\Controllers\Admin;

use App\Events\EventJobAdded;
use App\Events\EventJobsSendToParse;
use App\Jobs\NewsParsing;
use App\News\Category;
use App\News\News;
use App\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Queue;

class ParseController extends Controller
{
    public function index()
    {
        foreach (Resource::all() as $resource) {
            NewsParsing::dispatch($resource)->onQueue('parsing');
            EventJobsSendToParse::broadcast(Queue::size('parsing'));
        }

        return redirect(route('admin.resource.index'))->with('totalSteps', Queue::size('parsing'));
    }

}
