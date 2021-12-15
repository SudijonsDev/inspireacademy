<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisteredCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('registered_courses')) {
            Schema::create('registered_courses', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->enum('status', ['Y', 'N'])->default('Y');
                $table->unsignedBigInteger('learner_id');
                $table->unsignedBigInteger('course_id');
                $table->unsignedBigInteger('centre_id');
                $table->timestamps();
            });
            Schema::table('registered_courses', function ($table) {
                $table->foreign('learner_id')->references('id')->on('learners');
                $table->foreign('course_id')->references('id')->on('courses');
                $table->foreign('centre_id')->references('id')->on('centres');
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
        Schema::dropIfExists('registered_courses');
    }
}
