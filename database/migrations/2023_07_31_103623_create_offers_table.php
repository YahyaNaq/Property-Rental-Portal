<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->onDelete('cascade');
            $table->foreignId('user_id')->onDelete('cascade');
            $table->string('message');
            $table->unsignedBigInteger('amount_offered');
            $table->unsignedBigInteger('accepted_at_amount')->nullable();
            $table->boolean('is_pending')->default(true);
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
        Schema::dropIfExists('offers');
    }
}
