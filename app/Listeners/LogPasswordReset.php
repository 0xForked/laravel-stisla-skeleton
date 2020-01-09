<?php

namespace App\Listeners;

use App\Traits\ActivityLogger;
use Illuminate\Auth\Events\PasswordReset;

class LogPasswordReset
{
    use ActivityLogger;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param PasswordReset $event
     *
     * @return void
     */
    public function handle(PasswordReset $event)
    {
        ActivityLogger::activity('Reset Password');
    }

}
