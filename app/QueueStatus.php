<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueueStatus extends Model
{
    public $count;

    public function __construct($count,$attributes = [] )
    {
        parent::__construct($attributes);
        $this->count = $count;
    }
}
