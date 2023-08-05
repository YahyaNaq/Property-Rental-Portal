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
            $table->string('full_name');
            $table->string('username')->unique();
            $table->string('img_path')->nullable();
            $table->foreignId('property_id')->nullable();
            $table->unsignedSmallInteger('properties_took_for_rent')->default(0);
            $table->string('email')->unique();
            $table->string('phone_number', 19)->nullable()->unique();
            $table->string('about')->nullable();
            $table->string('city', 60)->nullable();
            $table->string('country', 60)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('password');
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
