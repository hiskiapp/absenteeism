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
        $in = AbsentStudents::simpleQuery()
        ->whereDate('date',date('Y-m-d'))
        ->where('is_out', 0)
        ->get();

        $arr = [];
        foreach ($in as $key => $row) {
            $arr[] = array($row->students_id);
        }

        $for = Students::simpleQuery()
        ->whereIn('id',$arr)
        ->get();

        $count = 0;
        foreach ($for as $key => $row) {
            $count += 1;
            $new = New AbsentStudents;
            $new->setDate(date('Y-m-d'));
            $new->setTimeIn(NULL);
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
