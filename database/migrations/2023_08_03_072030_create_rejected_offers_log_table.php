<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRejectedOffersLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rejected_offers_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->onDelete('cascade');
            $table->foreignId('user_id')->onDelete('cascade');
            $table->string('message');
            $table->unsignedBigInteger('amount_offered');
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
        Schema::dropIfExists('rejected_offers_log');
    }
}
