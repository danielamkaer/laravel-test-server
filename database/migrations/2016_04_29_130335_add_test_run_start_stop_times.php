<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTestRunStartStopTimes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('test_runs', function($table) {
            $table->datetime('start_time')->nullable();
            $table->datetime('end_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_runs', function($table) {
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
        });
    }
}
