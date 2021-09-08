<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JobReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_id');
            $table->string('user_id');
            $table->string('ticket_id');
            $table->string('ccntent');
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
        Schema::table('job_reports', function (Blueprint $table) {
            Schema::dropIfExists('job_reports');
        });
    }
}
