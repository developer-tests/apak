<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_registers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('auction_id');
            $table->string('item_id');
            $table->string('payment_method');
            $table->string('payment_detail')->nullable();
            $table->string('status')->default(0);
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('auction_registers');
    }
}
