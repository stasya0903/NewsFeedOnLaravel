<?php

namespace App\Http\Controllers\Admin;

use App\News\Category;
use App\News\News;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Json;

class IndexController extends Controller
{
    public function index() {
        return view('admin.index');
    }
}
