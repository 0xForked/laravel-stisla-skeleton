<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Console\Command;
use App\Notifications\NotifyInactiveUser;

class EmailInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:inactive-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email inactive users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $limit = Carbon::now()->subDay(7);
        $inactive_user = User::with([
            'login' => function ($query) {
                $query->select([
                    'user_id',
                    'user_agent',
                    'ip_address',
                    'created_at as last_login'
                ])->latest()->first();
            }
        ])->get();

        foreach ($inactive_user as $user) {
            if ($user->login[0]->last_login < $limit) {
                $user->notify(new NotifyInactiveUser());
            }
        }
    }
}
