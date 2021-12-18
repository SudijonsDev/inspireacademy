<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('sessions')) {
            Schema::create('sessions', function (Blueprint $table) {
                $table->id();
                $table->date('date_sessionDone');
                $table->integer('marksReceived');
                $table->unsignedBigInteger('course_id');
                $table->unsignedBigInteger('learner_id');
                $table->timestamps();
            });
            Schema::table('sessions', function ($table) {
                $table->foreign('course_id')->references('id')->on('courses');
                $table->foreign('learner_id')->references('id')->on('learners');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
