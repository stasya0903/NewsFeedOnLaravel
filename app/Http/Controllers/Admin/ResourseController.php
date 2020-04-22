<?php

namespace App\Http\Controllers\Admin;

use App\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Orchestra\Parser\Xml\Facade as XmlParser;
use XMLReader;

class ResourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('admin.resource.create',[
        'error' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
        /**TODO  валидация что передается url, проверка что такого ресурса уже нет**/
    {
        $xmlSrc = $request->get('xmlSrc');

        if($this->validateXmlSrc($xmlSrc )){
            $xml = XmlParser::load($xmlSrc);
            $data = $xml->parse([
                'title' => ['uses' => 'channel.title'],
                'link' => ['uses' => 'channel.link'],
                'image' => ['uses' => 'channel.image.url'],
            ]);
            $data['xmlSrc'] = $xmlSrc;

            $resource = Resource::create($data);
            if ($resource){
                return response()->view('admin.resource.create',[
                    'error' => 'Ресурс удачно добавлен'
                ]);
            }
        }else{
            return response()->view('admin.resource.create',[
                'error' => 'Данный источник не является валидным xml источником'
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resourse  $resourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resourse $resourse)
    {
        //
    }

    public function validateXmlSrc($src){
        $xmlReader = new XMLReader;
        $xmlReader->xml($src);
        return $xmlReader->isValid();
    }
}
