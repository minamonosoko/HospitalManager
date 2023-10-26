<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Validator::extend('next_appointment_date', function ($attribute, $value, $parameters, $validator) 
        {
            $previousDate = strtotime($parameters[0]); // 前回通院日
            $nextDate = strtotime($value); // 次回通院日
                        
            if ($nextDate > $previousDate && $nextDate > time()) 
            {
                return true;
            } 
            else 
            {
                return false;
            }
    
            return; // バリデーションルールを定義
        });
    }
}
