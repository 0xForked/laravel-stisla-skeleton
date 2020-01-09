<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait AccessLevel
{

    /**
     * Access Level Admin
     * @return Illuminate\Support\Facades\Auth
     */
    public static function isAdmin() {
        return Auth::user()->getRoleNames()->first() === 'admin';
    }

    /**
     * Access Level Customer Service
     * @return Illuminate\Support\Facades\Auth
     */
    public static function isStaff() {
        return Auth::user()->getRoleNames()->first() === 'staff';
    }

}
