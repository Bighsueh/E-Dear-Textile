<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JobReportFoldHead extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_foldHead_reports', function (Blueprint $table) {
            $table->id();
            $table->string('pickTower');
            $table->string('user_id');
            $table->string('ticket_id');
            $table->string('foldHead_order');
            $table->string('pickTower_order');
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
        Schema::table('job_foldHead_reports', function (Blueprint $table) {
            Schema::dropIfExists('job_foldHead_reports');
        });
    }
}
