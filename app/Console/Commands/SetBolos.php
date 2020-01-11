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
        if ($this->option('type') == 'ALL'){
            $not_in_students = AbsentStudents::simpleQuery()
            ->whereDate('date',date('Y-m-d'))
            ->get();

            $arr_students = [];
            foreach ($not_in_students as $key => $row) {
                $arr_students[] = array($row->students_id);
            }

            $for_students = Students::simpleQuery()
            ->whereNotIn('id',$arr_students)
            ->get();

            $count = 0;
            foreach ($for_students as $key => $row) {
                $count += 1;
                $new = New AbsentStudents;
                $new->setDate(date('Y-m-d'));
                $new->setTimeIn(NULL);
                $new->setStudentsId($row->id);
                $new->setType('Bolos');
                $new->setIsOut(NULL);
                $new->save();
            }

            $not_in_teachers = AbsentTeachers::simpleQuery()
            ->whereDate('date',date('Y-m-d'))
            ->get();

            $arr_teachers = [];
            foreach ($not_in_teachers as $key => $row) {
                $arr_teachers[] = array($row->teachers_id);
            }

            $for_teachers = Teachers::simpleQuery()
            ->whereNotIn('id',$arr)
            ->whereNot('weekdays','like','%'.date('l').'%')
            ->get();

            foreach ($for_teachers as $key => $row) {
                $count += 1;
                $new = New AbsentTeachers;
                $new->setDate(date('Y-m-d'));
                $new->setTimeIn(NULL);
                $new->setTeachersId($row->id);
                $new->setType('Bolos');
                $new->setIsOut(NULL);
                $new->save();
            }
        }elseif ($this->option('type') == 'students') {
            $not_in = AbsentStudents::simpleQuery()
            ->whereDate('date',date('Y-m-d'))
            ->get();

            $arr = [];
            foreach ($not_in as $key => $row) {
                $arr[] = array($row->students_id);
            }

            $for = Students::simpleQuery()
            ->whereNotIn('id',$arr)
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
        }elseif($this->option('type') == 'teachers'){
            $not_in = AbsentTeachers::simpleQuery()
            ->whereDate('date',date('Y-m-d'))
            ->get();

            $arr = [];
            foreach ($not_in as $key => $row) {
                $arr[] = array($row->teachers_id);
            }

            $for = Teachers::simpleQuery()
            ->whereNotIn('id',$arr)
            ->where('weekdays','like','%'.date('l').'%')
            ->get();

            $count = 0;
            foreach ($for as $key => $row) {
                $count += 1;
                $new = New AbsentTeachers;
                $new->setDate(date('Y-m-d'));
                $new->setTimeIn(NULL);
                $new->setTeachersId($row->id);
                $new->setType('Bolos');
                $new->setIsOut(NULL);
                $new->save();
            }
        }else{
            $count = 'Error'; 
        }

        if ($count == 0) {
            $this->info('There is nothing you need to set!');
        }elseif ($count == 'Error') {
            $this->info('Error :(');
        }else{
            $this->info('Set Alpa to Students Successfully!');
        }
    }
}
