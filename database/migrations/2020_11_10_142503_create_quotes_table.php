<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->mediumText('quote');
            $table->unsignedBigInteger('character_id')->nullable();
            $table->unsignedBigInteger('episode_id')->nullable();

            $table->foreign('character_id')->references('id')->on('characters');
            $table->foreign('episode_id')->references('id')->on('episodes');

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
        Schema::dropIfExists('quotes');
    }
}
