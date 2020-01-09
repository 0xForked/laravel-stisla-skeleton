<?php

use App\Models\Setting;

if (! function_exists('app_settings')) {
    function app_settings()
    {
        return to_assoc_array(Setting::all());;
    }
}
