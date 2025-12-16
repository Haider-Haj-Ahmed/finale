<?php

use App\Models\User;
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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('destination');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('type',['solo','group']);
            $table->enum('status',['active','inactive','completed']);
            $table->timestamps();
        });
        Schema::create('location_trip', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained()->onDelete('cascade');
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->enum('visit_type',['planned','visited']);
            $table->date('visit_date')->nullable();
            $table->unsignedInteger('order');
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_trip');
        Schema::dropIfExists('trips');
    }
};
