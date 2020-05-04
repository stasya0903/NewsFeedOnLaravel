<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueueStatus extends Model
{
    public $count;

    public function __construct(array $attributes = [], $count)
    {
        parent::__construct($attributes);
        $this->count = $count;
    }
}
