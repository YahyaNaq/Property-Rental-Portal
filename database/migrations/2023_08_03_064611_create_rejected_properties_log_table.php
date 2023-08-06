<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRejectedPropertiesLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rejected_properties_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->onDelete('cascade');
            $table->foreignId('category_id');
            $table->foreignId('location_id');
            $table->string('title');
            $table->string('description', 2000);
            $table->unsignedSmallInteger('area');
            $table->unsignedBigInteger('monthly_rent');
            $table->string('bedrooms');
            $table->unsignedTinyInteger('bathrooms');
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
        Schema::dropIfExists('rejected_properties_log');
    }
}
