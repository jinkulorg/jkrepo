<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'profile_pic_path',
        'user_id',
        'gender',
        'physical_status',
        'height',
        'weight',
        'hobby',
        'complexion',
        'specs',
        'vegetarian',
        'non-vegetarian',
        'eggetarian',
        'drink',
        'smoke',
        'self_description',
        'profile_created_by',
        'subcast',
        'birth_date',
        'birth_time',
        'birth_place',
        'native',
        'marital_status',
        'rashi',
        'mangal',
        'shani',
        'highest_education',
        'education_details',
        'occupation',
        'area_of_business',
        'designation',
        'company_name',
        'annual_income',
        'contact_no',
        'present_address',
        'present_city',
        'present_taluka',
        'present_district',
        'present_state',
        'present_country',
        'present_pincode',
        'permanent_address',
        'permanent_city',
        'permanent_taluka',
        'permanent_district',
        'permanent_state',
        'permanent_country',
        'permanent_pincode',
        'father_name',
        'father_occupation',
        'father_annual_income',
        'father_contact_no',
        'mother_name',
        'mother_occupation',
        'mother_income',
        'mother_contact_no',
        'no_of_brothers',
        'no_of_sisters',
        'status'
    ];

    public $timestamps = true;

    protected $table = 'profiles';
    
    /**
     * One to One relationship between User and Profile.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function Request_received() {
        return $this->hasMany('App\Request_received');
    }

    public function Request_sent() {
        return $this->hasMany('App\Request_sent');
    }

    public function Reference() {
        return $this->hasMany('App\Reference');
    }

    public function Married()
    {
        return $this->hasOne('App\Married');
        
    }
}