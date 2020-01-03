<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Students;
use App\Models\AbsentStudents;

class SetBolos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:bolos';

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
        $data = AbsentStudents::simpleQuery()
        ->whereDate('date',date('Y-m-d'))
        ->where('is_out', 0)
        ->get();

        $count = 0;
        foreach ($data as $key => $row) {
            $count += 1;
            $new = AbsentStudents::findById($row->id);
            $new->setDate(date('Y-m-d'));
            $new->setStudentsId($row->id);
            $new->setType('Bolos');
            $new->setIsOut(NULL);
            $new->save();
        }

        if ($count == 0) {
            $this->info('There is nothing you need to set!');
        }else{
            $this->info('Set Bolos Successfully!');
        }
    }
}
