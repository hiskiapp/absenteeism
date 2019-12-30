<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nis');
            $table->string('name');
            $table->string('gender');
            $table->integer('class_id');
            $table->integer('rayons_id');
            $table->string('birth_city')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('religion');
            $table->text('address')->nullable();
            $table->string('name_of_guardian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
