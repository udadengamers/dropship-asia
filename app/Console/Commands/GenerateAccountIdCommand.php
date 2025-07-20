<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class GenerateAccountIdCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:account-id';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        User::chunk(100, function($users) {
            foreach ($users as $user) {
                if (!$user->account_id) {
                    $first = ($user->email ? substr($user->email, 0, strpos($user->email, '@')) : $user->phone );
                    $last = uniqid();
                    $user->update([
                        'account_id' => $first . $last
                    ]);
                }
            }
        });
    }
}
