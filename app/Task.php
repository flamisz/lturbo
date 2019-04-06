<?php

namespace App;

use App\Time;
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

    public function start()
    {
        return $this->times()->create(['start' => now()]);
    }

    public function stop()
    {
        $time = $this->times()->whereNull('stop')->first();

        $time->update(['stop' => now()]);

        return $time;
    }

    public function times()
    {
        return $this->hasMany(Time::class);
    }
}
