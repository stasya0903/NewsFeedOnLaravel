<?php

use App\Resource;
use Illuminate\Database\Seeder;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $sources = [
        'http://img.lenta.ru/r/EX/import.rss',
        'https://www.vedomosti.ru/rss/issue',
        'http://www.ej.by/news/news.rss',
        /*'http://img.lenta.ru/r/EX/import.rss',
        'https://www.vedomosti.ru/rss/issue',
        'http://www.ej.by/news/news.rss',
        'http://img.lenta.ru/r/EX/import.rss',
        'https://www.vedomosti.ru/rss/issue',
        'http://www.ej.by/news/news.rss',
        'http://img.lenta.ru/r/EX/import.rss',
        'https://www.vedomosti.ru/rss/issue',
        'http://www.ej.by/news/news.rss',
        'http://img.lenta.ru/r/EX/import.rss',
        'https://www.vedomosti.ru/rss/issue',
        'http://www.ej.by/news/news.rss',*/

    ];

    public function run()
    {
        foreach ($this->sources as $source){
            $xml = XmlParser::load($source);
            $data = $xml->parse([
                'title' => ['uses' => 'channel.title'],
                'link' => ['uses' => 'channel.link'],
                'image' => ['uses' => 'channel.image.url'],
            ]);
            $data['xmlSrc'] = $source;
            factory(Resource::class, 1)->create($data);
        }
    }
}
