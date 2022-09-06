<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDubaiTerminateNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dubai_terminate_numbers', function (Blueprint $table) {
            $table->id();
            $table->date("date")->index();
            $table->string("time");
            $table->string("number");
            $table->bigInteger("branch_id")->unsigned();
            $table->timestamps();
            $table->foreign("number")->references("number")->on("twod_lists");
            $table->foreign("time")->references("name")->on("twod_times");
            $table->foreign("branch_id")->references("id")->on("branches");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dubai_terminate_numbers');
    }
}
