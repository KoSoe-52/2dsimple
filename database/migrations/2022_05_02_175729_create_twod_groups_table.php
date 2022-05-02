<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwodGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twod_groups', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("twod_type_id")->unsigned();
            $table->bigInteger("twod_id")->unsigned();
            $table->foreign("twod_type_id")->references("id")->on("twod_types");
            $table->foreign("twod_id")->references("id")->on("twod_lists");
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
        Schema::dropIfExists('twod_groups');
    }
}
