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
            $table->timestamps();
            $table->string('employeeName');
            $table->string('item');
            $table->string('itemId');
            $table->string('factory');
            $table->string('color');
            $table->string('wash');
            $table->string('color_line');
            $table->string('rollFunc');
            $table->string('manager');
            $table->double('order');
            $table->string('ps')->nullable();
            $table->string('status')->nullable();
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
