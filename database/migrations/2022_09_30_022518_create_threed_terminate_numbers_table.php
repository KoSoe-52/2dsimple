<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreedTerminateNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threed_terminate_numbers', function (Blueprint $table) {
            $table->id();
            $table->date("date")->index();
            $table->string("number");
            $table->bigInteger("branch_id")->unsigned();
            $table->foreign("number")->references("number")->on("threed_lists");
            $table->foreign("branch_id")->references("id")->on("branches");
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
        Schema::dropIfExists('threed_terminate_numbers');
    }
}
