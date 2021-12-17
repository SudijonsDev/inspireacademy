<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisteredLearnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('registered_learners')) {
            Schema::create('registered_learners', function (Blueprint $table) {
                $table->id();
                $table->smallInteger('noOfLearners');
                $table->unsignedBigInteger('regCourseId');
                $table->timestamps();
            });
            Schema::table('registered_learners', function ($table) {
                $table->foreign('regCourseId')->references('id')->on('courses');
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
        Schema::dropIfExists('registered_learners');
    }
}
