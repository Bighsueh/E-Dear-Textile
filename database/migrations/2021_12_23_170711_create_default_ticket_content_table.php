<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultTicketContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_ticket_content', function (Blueprint $table) {
            $table->id('content_id');
            $table->string('customer_name');
            $table->string('item_no');
            $table->string('color');
            $table->string('wash_tag');
            $table->string('item');
            $table->string('blenching_and_dyeing_factory');
            $table->string('color_thread');
            $table->string('piping_method');
            $table->string('remark');
            $table->string('ticket_status');
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
        Schema::dropIfExists('default_ticket_content');
    }
}
