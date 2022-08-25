<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('auction_notice');
            $table->string('bidding_notes');
            $table->integer('sellerid');
            $table->integer('auctioneerid');
            $table->bigInteger('categoryid');
            $table->float('latitude');
            $table->float('longitude');
            $table->string('location');
            $table->text('information');
            $table->tinyInteger('status');
            $table->text('terms_conditions');
            $table->text('payment_info');
            $table->text('shipping_pickup');
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
        Schema::dropIfExists('auctions');
    }
}
