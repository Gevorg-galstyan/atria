<?php

namespace App\Console\Commands;

use App\Models\ConfirmUsers;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CronJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:cronjob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User delete Successfully';

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
        $confirm_users = ConfirmUsers::get();
        foreach ($confirm_users as $confirm_user) {
            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());
            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $confirm_user->updated_at);
            $diff_in_hours = $to->diffInHours($from);
            if ($diff_in_hours > 1){
                $user = DB::table('users')->where('email', $confirm_user->email)->first();
                if ($user->status == 0){
                    DB::table('users')->where('email', $confirm_user->email)->delete();
                }
                $confirm_user->delete();
            }
        }
        $this->info('User delete Successfully!');
    }
}
