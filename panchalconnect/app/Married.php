<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Married extends Model
{
    protected $guarded = [];

    public function Profile()
    {
        return $this->belongsTo('App\Profile');
    }
}
