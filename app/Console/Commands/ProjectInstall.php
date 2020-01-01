<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Users;
use Hash;

class ProjectInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Project';

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
        $this->header();
        $this->info('Installing: ');

        if ($this->confirm('Do you have setting the database configuration at .env ?')) {
            $this->info('Migrating database...');
            $this->call('migrate');
            $this->call('config:clear');
            $this->call('key:generate');

            $user = Users::simpleQuery()->first();
            if (!$user) {
                $email = 'admin@siabsensi.com';
                $password = '12345678';
                $user = New Users;
                $user->setPhoto('images/1577776687.jpeg');
                $user->setName('Administrator');
                $user->setEmail($email);
                $user->setPassword(Hash::make($password));
                $user->save();
            }else{
                $email = $user->email;
                $password = '********';
            }

            $this->info('Installing Siabsensi Is Completed ! Thank You :)');
            $this->info('--');
            $this->info("::Administrator Credential::\n URL Login: http://localhost/login\nEmail: $email \nPassword: $password");
        }else{
            $this->info('Setup Aborted !');
            $this->info('Please setting the database configuration for first !');
        }

        $this->footer();
    }

    private function header(){
        $this->info('--------- :===: Siabsensi By HiskiaDev :==: ---------------');
        $this->info('====================================================================');
    }

    private function footer()
    {
        $this->info('--');
        $this->info('Website : https://hiskia.dev');
        $this->info('Github : https://github.com/hiskiadev/siabsensi');
        $this->info('====================================================================');
        $this->info('------------------- :===: Completed !! :===: ------------------------');
        exit;
    }
}
