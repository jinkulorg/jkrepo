<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request_received extends Model
{
    protected $guarded = [];
    
    public function Request_sent() {
        return $this->belongsTo('App\Request_sent');
    }

    public function Profile() {
        return $this->belongsTo('App\Profile');
    }
}
