<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bets', function (Blueprint $table) {
            $table->id();
            $table->date("date")->index();
            $table->string("time");
            $table->string("number",3);
            $table->double("amount",12,2);
            $table->bigInteger("user_id")->unsigned();
            $table->string("token",40);
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("time")->references("name")->on("twod_times");
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
        Schema::dropIfExists('bets');
    }
}
