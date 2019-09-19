<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request_sent extends Model
{
    protected $guarded = [];

    public function Request_received() {
        return $this->hasOne('App\Request_received');
    }

    public function Profile() {
        return $this->belongsTo('App\Profile');
    }
}
