<?php

namespace App\Listeners;

use App\Traits\ActivityLogger;
use Illuminate\Auth\Events\Lockout;

class LogLockout
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
     * @param Lockout $event
     *
     * @return void
     */
    public function handle(Lockout $event)
    {
        ActivityLogger::activity('Locked Out');
    }

}
