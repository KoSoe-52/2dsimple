<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreedLuckyRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threed_lucky_records', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("phone")->nullable();
            $table->date("date")->index();
            $table->string("number");
            $table->double("price",12,2);
            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("vouncher_id")->index();
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("number")->references("number")->on("threed_lists");
            $table->datetime("inser_date_time");
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
        Schema::dropIfExists('threed_lucky_records');
    }
}
