<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldToAbsentStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('absent_students', function (Blueprint $table) {
            $table->dropColumn('datetime');
            $table->date('date')->after('id');
            $table->time('time_in')->nullable()->after('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('absent_students', function (Blueprint $table) {
            //
        });
    }
}
