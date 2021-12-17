<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('learners')) {
            Schema::create('learners', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('surname');
                $table->enum('agreement', ['Y', 'N'])->default('N');
                $table->unsignedBigInteger('centre_id');
                $table->timestamps();
            });
            Schema::table('learners', function ($table) {
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
        Schema::dropIfExists('learners');
    }
}
