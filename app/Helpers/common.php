<?php

use App\Models\GeneralSetting;

/*
Informações do site
*/

if (!function_exists('settings')) {
    function settings()
    {
        $settings = GeneralSetting::first();

        if ($settings)
            return $settings;
    }
}
