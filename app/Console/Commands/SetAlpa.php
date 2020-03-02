<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\AbsentStudentsRepository;
use App\Repositories\AbsentTeachersRepository;
use App\Repositories\NotificationsRepository;

class SetAlpa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:alpa {--type=ALL : Set New Password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set Students / Teachers Status Today to Alpa';

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
        if (isholiday()) {
            $this->info('Today is Holiday!');
        }else{
            if ($this->option('type') == 'ALL'){
                $result = AbsentStudentsRepository::set('Tanpa Keterangan');
                $result += AbsentTeachersRepository::set('Tanpa Keterangan');

                $notif['icon'] = 'user';
                $notif['color'] = 'primary';
                $notif['title'] = 'Berhasil Menandai Siswa & Guru Yang Alpa';
                $notif['description'] = 'Ini Adalah Notifikasi Otomatis Dari Sistem.';
                $notif['url'] = url('absent/students/list');
                NotificationsRepository::add($notif);

            }elseif ($this->option('type') == 'students') {
                $result = AbsentStudentsRepository::set('Tanpa Keterangan');
            }elseif($this->option('type') == 'teachers'){
                $result = AbsentTeachersRepository::set('Tanpa Keterangan');
            }else{
                $result = 'Error'; 
            }

            if ($result == 0) {
                $this->info('There is nothing you need to set!');
            }elseif ($result == 'Error') {
                $this->info('Error :(');
            }else{
                $this->info('Set Alpa to Students Successfully!');
            }
        }
    }
}
