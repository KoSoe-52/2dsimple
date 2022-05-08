<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwodHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twod_histories', function (Blueprint $table) {
            $table->id();
            $table->date("date")->index();
            $table->string("time");
            $table->string("number");
            $table->foreign("time")->references("name")->on("twod_times");
            $table->foreign("number")->references("number")->on("twod_lists");
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
        Schema::dropIfExists('twod_histories');
    }
}
