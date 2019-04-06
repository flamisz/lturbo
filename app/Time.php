<?php

namespace App;

use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    public $timestamps = false;

    protected $casts = [
        'start' => 'datetime',
        'stop' => 'datetime',
    ];

    protected $guarded = [];

    public function getLengthAttribute()
    {
        if (is_null($this->stop)) {
            return CarbonInterval::create(0);
        }

        return $this->start->diffAsCarbonInterval($this->stop);
    }
}
