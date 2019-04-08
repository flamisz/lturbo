<?php

namespace App;

use App\Time;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    public function path()
    {
        return "/tasks/{$this->id}";
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function toggle()
    {
        if ($time = $this->times()->whereNull('stop')->first()) {
            $time->update(['stop' => now()]);

            return $time;
        }

        return $this->times()->create(['start' => now()]);
    }

    public function times()
    {
        return $this->hasMany(Time::class)->latest('start');
    }

    public function hasUnstoppedTime()
    {
        return ! ! $this->times->where('stop', null)->count();
    }

    public function getLengthAttribute()
    {
        $length = CarbonInterval::create(0);

        $this->times->each(function ($time) use ($length) {
            $length = $length->add($time->length);
        });

        return $length;
    }
}
