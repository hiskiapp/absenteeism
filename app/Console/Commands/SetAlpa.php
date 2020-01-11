<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Students;
use App\Models\AbsentStudents;
use App\Models\Teachers;
use App\Models\AbsentTeachers;

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
        if (now()->isWeekend()) {
            $result = 'Weekend';
        }elseif ($this->option('type') == 'ALL'){
            $result = AbsentStudentsRepository::set('Tanpa Keterangan');
            $result += AbsentTeachersRepository::set('Tanpa Keterangan');
        }elseif ($this->option('type') == 'students') {
            $result = AbsentStudentsRepository::set('Tanpa Keterangan');
        }elseif($this->option('type') == 'teachers'){
            $result += AbsentTeachersRepository::set('Tanpa Keterangan');
        }else{
            $result = 'Error'; 
        }

        if ($result == 'Weekend'){
            $this->info('This is the weekend!');
        }elseif ($result == 0) {
            $this->info('There is nothing you need to set!');
        }elseif ($result == 'Error') {
            $this->info('Error :(');
        }else{
            $this->info('Set Alpa to Students Successfully!');
        }
    }
}
