<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function path()
    {
        return "/tasks/{$this->id}";
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
