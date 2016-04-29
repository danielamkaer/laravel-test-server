<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_run_id')->unsigned();
            $table->string('name');
            $table->string('filename');
            $table->timestamps();
            $table->foreign('test_run_id')->references('id')->on('test_runs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('test_files');
    }
}
