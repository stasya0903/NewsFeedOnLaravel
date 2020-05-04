<?php

namespace App\Jobs;

use App\Events\EventJobAdded;
use App\Services\XmlParserService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Queue\RedisQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Queue;

class NewsParsing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $resource;

    /**
     * Create a new job instance.
     *
     * @param $resource
     */
    public function __construct($resource)
    {
         $this->resource = $resource;
    }

    /**
     * Execute the job.
     *
     * @param XmlParserService $parserService
     * @return void
     */
    public function handle(XmlParserService $parserService)
    {
        broadcast(new EventJobAdded(Queue::size('parsing')));
         $parserService->saveNews($this->resource);
    }
}
