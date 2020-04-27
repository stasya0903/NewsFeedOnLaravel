<?php

namespace App\Jobs;

use App\Services\XmlParserService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class NewsParsing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $link;

    /**
     * Create a new job instance.
     *
     * @param $link
     */
    public function __construct($link)
    {
         $this->link = $link;
    }

    /**
     * Execute the job.
     *
     * @param XmlParserService $parserService
     * @return void
     */
    public function handle(XmlParserService $parserService)
    {
        $parserService->saveNews($this->link);
    }
}
