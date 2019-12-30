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
        Builder::macro('search', function($attribute_values_map) {
            foreach($attribute_values_map as $attribute => $value) {
                if ($value == null) {
                    continue;
                }
                $this->where($attribute, 'Like' , $value);
            }
            return $this;
        });
    }
}
