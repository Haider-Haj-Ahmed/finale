<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('latitude');
            $table->string('longitude');
            // need to talk about it
            $table->string('address');
            //should be enum of types like city, country, landmark
            $table->string('type');
            //if it is added by normal user to their location on their private trip this location wont be shown in the global locations
            $table->enum('status',['public','private']);
            $table->timestamps();
        });
        Schema::create('location_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_user');
        Schema::dropIfExists('locations');
    }
};
