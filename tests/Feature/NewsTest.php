<?php

namespace Tests\Feature;

use App\News\News;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNewsIsArray()
    {
        $news = News::getNews();

        self::assertIsArray($news);
    }

    public function testGetingNewsByIdIsArray()
    {
        $newsItem = News::getNewsId(-5);

        self::assertIsArray($newsItem);
    }

    public function testNotUpdatingNewsWithNoData()
    {
        $newsItem = News::getNewsId(-5);

        self::assertIsArray($newsItem);
    }


}
