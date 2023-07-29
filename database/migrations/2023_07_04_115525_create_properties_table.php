<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->onDelete('cascade')->nullable();;
            $table->foreignId('agent_id')->onDelete('cascade');
            $table->foreignId('category_id');
            $table->string('title', 100);
            $table->string('description', 1500);
            $table->string('city');
            $table->string('location', 50);
            $table->unsignedSmallInteger('area');
            $table->unsignedBigInteger('monthly_rent');
            $table->string('bedrooms');
            $table->unsignedTinyInteger('bathrooms');
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_rented')->default(false);
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
        Schema::dropIfExists('properties');
    }
}
