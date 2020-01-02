<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Users;
use App\Models\Settings;
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

            $settings = Settings::simpleQuery()->first();
            if (!$settings) {
                $insert[] = [
                    'slug' => 'title',
                    'title' => 'Title',
                    'content' => 'SMK Wikrama 1 Jepara'
                ];
                $insert[] = [
                    'slug' => 'time_in',
                    'title' => 'Jam Masuk',
                    'content' => '07:00'
                ];
                $insert[] = [
                    'slug' => 'time_out',
                    'title' => 'Jam Keluar',
                    'content' => '16:00'
                ];
                $insert[] = [
                    'slug' => 'set_alpa',
                    'title' => 'Set Alpa',
                    'content' => '10:00'
                ];
                $insert[] = [
                    'slug' => 'set_bolos',
                    'title' => 'Set Bolos',
                    'content' => '17:00'
                ];

                Settings::simpleQuery()->insert($insert);
            }
            
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
