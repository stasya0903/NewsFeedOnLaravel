<?php


namespace App\Services;


use App\News\News;
use Carbon\Carbon;

class NewsAgeService
{
    public $minimumAge;
    public $maximumAge;
    public $currentAgesArray;

    public function __construct()
    {
        $this->maximumAge = $this->setTheMaximumAge();
        $this->minimumAge = $this->setTheMinimumAge();
        $this->currentAgesArray = $this->generateCurrentAgesArray();

    }


    public function setTheMinimumAge()
    {
        $minimumAge = 0;
        $youngestNewItem = News::query()->orderByDesc('created_at')->first();
        if ($youngestNewItem) {
            $minimumAge = $this->getDifferenceInDays($youngestNewItem->created_at);
        }

        return $minimumAge;


    }

    public function setTheMaximumAge()
    {
        $maximumAge = 0;

        $oldestNewsItem = News::query()->orderBy('created_at')->first();
        if ($oldestNewsItem) {
            $maximumAge = $this->getDifferenceInDays($oldestNewsItem->created_at);
        }

        return $maximumAge;
    }


    public function generateCurrentAgesArray(): array
    {
        $currentAgesArray = [];
        $start = $this->minimumAge;
        $finish = $this->maximumAge;

        while ($start < $finish) {
            $start++;
            $currentAgesArray[] = $start;
        }

        return $currentAgesArray;


    }

    public function getDifferenceInDays($newsCreationDate)
    {
        return $newsCreationDate->diffInDays(New Carbon(now()));
    }


}
