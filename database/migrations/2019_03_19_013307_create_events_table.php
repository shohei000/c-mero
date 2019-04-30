<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('event_name')->nullable();
            $table->string('location_name')->nullable();
            $table->string('location_url')->nullable();
            $table->string('open_date')->nullable();
            $table->string('event_open')->nullable();
            $table->string('event_start')->nullable();
            $table->string('ticket_price')->nullable();
            $table->string('event_cap')->nullable();
            $table->string('cap_none_num')->default(1);
            $table->string('cap_delete_flg')->default(0);
            $table->tinyInteger('event_day')->default(1);
            $table->string('supplement')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('events');
    }
}
