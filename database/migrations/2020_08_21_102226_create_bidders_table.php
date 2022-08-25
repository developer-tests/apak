<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiddersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bidders', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('company');
            $table->integer('country');
            $table->integer('state');
            $table->integer('city');
            $table->string('postal_code');
            $table->string('phone1');
            $table->string('phone2');
            $table->string('fax');
            $table->string('username');
            $table->string('password');
            $table->tinyInteger('status');
            $table->tinyInteger('hide_username');
            $table->tinyInteger('send_notification');
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
        Schema::dropIfExists('bidders');
    }
}
