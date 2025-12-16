<?php

use App\Models\Image;
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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Image::class)->nullable()->constrained()->onDelete('cascade');
            $table->enum('gender',['male','female']);
            $table->enum('state',['user','explorer']);
            $table->integer('follwers')->default(0);
            $table->integer('followings')->default(0);
            $table->string('bio')->nullable();
            $table->timestamps();
            //estamations
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
