<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('profile_pic_path')->nullable();
            $table->char('gender')->nullable();
            $table->string('physical_status')->nullable();
            $table->float('height')->nullable();
            $table->integer('weight')->nullable();
            $table->string('hobby')->nullable();
            $table->string('complexion')->nullable();
            $table->string('specs')->nullable();
            $table->string('vegetarian')->nullable();
            $table->string('non_vegetarian')->nullable();
            $table->string('eggetarian')->nullable();
            $table->string('drink')->nullable();
            $table->string('smoke')->nullable();
            $table->string('self_description')->nullable();
            $table->string('profile_created_by')->nullable();
            $table->string('subcast')->nullable();
            $table->date('birth_date')->nullable();
            $table->time('birth_time')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('native')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('rashi')->nullable();
            $table->boolean('mangal')->nullable();
            $table->boolean('shani')->nullable();
            $table->string('education')->nullable();
            $table->string('occupation')->nullable();
            $table->string('area_of_business')->nullable();
            $table->string('designation')->nullable();
            $table->string('company_name')->nullable();
            $table->bigInteger('annual_income')->nullable();
            $table->bigInteger('contact_no')->nullable();
            $table->string('present_address')->nullable();
            $table->string('present_city')->nullable();
            $table->string('present_taluka')->nullable();
            $table->string('present_district')->nullable();
            $table->string('present_state')->nullable();
            $table->string('present_country')->nullable();
            $table->string('present_pincode')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('permanent_city')->nullable();
            $table->string('permanent_taluka')->nullable();
            $table->string('permanent_district')->nullable();
            $table->string('permanent_state')->nullable();
            $table->string('permanent_country')->nullable();
            $table->string('permanent_pincode')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->bigInteger('father_annual_income')->nullable();
            $table->bigInteger('father_contact_no')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->bigInteger('mother_annual_income')->nullable();
            $table->bigInteger('mother_contact_no')->nullable();
            $table->string('no_of_brothers')->nullable();
            $table->string('no_of_sisters')->nullable();
            $table->string('status')->nullable();
            $table->string('recently_viewed_profiles')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
