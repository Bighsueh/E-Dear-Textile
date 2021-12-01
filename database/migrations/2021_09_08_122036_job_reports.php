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
            $table->string('action');
            $table->string('operator');
            $table->string('ticket_id');
            $table->float('quantity');
            $table->string('unit');
            $table->string('submit_by');
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
