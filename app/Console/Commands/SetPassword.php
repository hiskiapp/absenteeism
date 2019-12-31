<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\Users;
use Hash;

class SetPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:password {--password=AUTO : Set New Password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set New Password Administrator';

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
        if ($this->option('password') == 'AUTO') {
            $password = Str::random(8);
        }else{
            $password = $this->option('password');
        }

        $edit = Users::findById(1);
        $edit->setPassword(Hash::make($password));
        $edit->save();

        $this->info("::New Password::\nPassword: $password");
    }
}
