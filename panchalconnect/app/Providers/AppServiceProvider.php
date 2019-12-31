<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('search', function ($attribute_values_map, $wherein_attr_val_map) {
            // echo "query:<br>";
            foreach ($attribute_values_map as $attribute => $value) {
                if ($value == null) {
                    continue;
                }
                // echo $attribute . " => " . $value . "<br>";
                $this->where($attribute, 'Like', $value);
            }
            foreach ($wherein_attr_val_map as $attribute => $value) {
                if ($value == null) {
                    continue;
                }
                // echo $attribute . " => ";
                // print_r($value);
                // echo "<br>";
                $this->whereIn($attribute, $value);
            }
            return $this;
        });
    }
}
