<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\AbsentStudentsRepository;
use App\Repositories\AbsentTeachersRepository;

class SetBolos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:bolos {--type=ALL : Set New Password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set Students Status Today to Bolos';

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
                $result = AbsentStudentsRepository::set('Bolos');
                $result += AbsentTeachersRepository::set('Bolos');
            }elseif ($this->option('type') == 'students') {
                $result = AbsentStudentsRepository::set('Bolos');
            }elseif($this->option('type') == 'teachers'){
                $result = AbsentTeachersRepository::set('Bolos');
            }else{
                $result = 'Error'; 
            }

            if ($result == 0) {
                $this->info('There is nothing you need to set!');
            }elseif ($result == 'Error') {
                $this->info('Error :(');
            }else{
                $this->info('Set Bolos to Students Successfully!');
            }
        }
    }
}
