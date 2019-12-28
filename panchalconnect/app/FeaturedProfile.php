<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeaturedProfile extends Model
{
    protected $guarded = [];

    public function Profile()
    {
        return $this->belongsTo('App\Profile');
    }
}
