<?php

use App\Traits\UserAgentDetails;
use App\Models\Activity\Login as LoginActivity;

if (! function_exists('login_activity')) {
    // use this function when . . . . .
    function login_activity()
    {
        return LoginActivity::whereUserId(auth()->user()->id)->latest()->first();
    }
}

if (! function_exists('user_agent_details')) {
    // use this function when . . . .
    function user_agent_details($agent) {
        return UserAgentDetails::details($agent);
    }
}

