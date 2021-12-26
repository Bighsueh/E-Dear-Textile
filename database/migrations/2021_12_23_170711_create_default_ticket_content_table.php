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
            $table->string('customer_name')->nullable();
            $table->string('item_no')->nullable();
            $table->string('color')->nullable();
            $table->string('wash_tag')->nullable();
            $table->string('item')->nullable();
            $table->string('blenching_and_dyeing_factory')->nullable();
            $table->string('color_thread')->nullable();
            $table->string('piping_method')->nullable();
            $table->string('remark')->nullable();
            $table->string('ticket_status')->nullable();
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
