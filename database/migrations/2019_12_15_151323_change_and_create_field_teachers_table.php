<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAndCreateFieldTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teachers', function($table) {
             $table->dropColumn('subjects_id');
             $table->dropColumn('position_id');
             $table->string('subjects')->nullable()->after('name');
             $table->string('position')->nullable()->after('subjects');
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
