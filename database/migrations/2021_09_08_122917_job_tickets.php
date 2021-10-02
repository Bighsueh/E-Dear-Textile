<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JobTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('employeeName');
            $table->string('item');
            $table->string('itemId');
            $table->string('factory');
            $table->string('color');
            $table->string('wash');
            $table->string('colorId');
            $table->string('colorId2');
            $table->string('cloth');
            $table->string('rollFunc');
            $table->string('manager');
            $table->string('order');
            $table->string('ps');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_tickets', function (Blueprint $table) {
            Schema::dropIfExists('job_tickets');
        });
    }
}
