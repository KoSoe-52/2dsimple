<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDubiaLuckRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dubia_luck_records', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("phone")->nullable();
            $table->date("date");
            $table->string("time");
            $table->string("number");
            $table->double("price",12,2);
            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("vouncher_id");
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("number")->references("number")->on("twod_lists");
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
        Schema::dropIfExists('dubia_luck_records');
    }
}
