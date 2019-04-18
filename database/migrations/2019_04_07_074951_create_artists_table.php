<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->default(0);
            $table->string('artist_name')->nullable();
            $table->string('artist_youtube')->nullable();
            $table->string('artist_tw')->nullable();
            $table->string('artist_time')->nullable();
            $table->string('artist_cap')->nullable();
            $table->string('delete_flg')->default(0);
            $table->string('cap_delete_flg')->default(0);
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
        Schema::dropIfExists('artists');
    }
}
