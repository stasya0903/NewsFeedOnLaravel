<?php

namespace App\Http\Controllers\Admin;

use App\News\News;
use App\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Orchestra\Parser\Xml\Facade as XmlParser;


class ResourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('admin.resource.index', [
            'resources' => Resource::all()
        ]);
    }

    public function show(Resource $resource)
    {
        return response()->view('admin.resource.show', [
            'resource' => $resource,
            'news'=> $resource->news()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->isDataValid($request);
        try {
            $xmlSrc = $request->get('xmlSrc');
            $data = $this->parseData($xmlSrc);
            $resource = Resource::create($data);
            if ($resource) {
                return redirect(route('admin.resource.index'))->with(
                    'success', 'Ресурс удачно добавлен'
                );
            }
        } catch (\Exception $e) {
            $request->flash();
            return redirect(route('admin.resource.index'))->with(
                'error', 'Данный источник не является валидным xml источником'
            );
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Resource $resourse
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy( Resource $resource)
    {
        $result = $resource->delete();
        if ($result) {
            return redirect(route('admin.resource.index'))->with("success", 'Ресурс успешно удалена');
        } else {
            return redirect(route('admin.resource.index'))->with("error", 'Ошибка сервера');
        }
    }

    public function isDataValid($request)
    {
        return $this->validate($request,
            Resource::rules(),
            Resource::instructions(),
            []
        );
    }

    public function parseData($xmlSrc)
    {
        $xml = XmlParser::load($xmlSrc);
        $data = $xml->parse([
            'title' => ['uses' => 'channel.title'],
            'link' => ['uses' => 'channel.link'],
            'image' => ['uses' => 'channel.image.url'],
        ]);
        $data['xmlSrc'] = $xmlSrc;

        return $data;
    }
}
