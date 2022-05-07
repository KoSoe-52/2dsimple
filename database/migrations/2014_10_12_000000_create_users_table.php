<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('password');
            $table->string("phone");
            $table->integer("status")->default(1)->comment("1 is active 2 is inactive");
            $table->integer("break")->nullable();
            $table->bigInteger("role_id")->unsigned();
            $table->foreign("role_id")->references("id")->on("roles");
            $table->bigInteger("branch_id")->unsigned();
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
        Schema::dropIfExists('users');
    }
}
