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
        Schema::create('follows', function (Blueprint $table) {
            $table->unsignedBigInteger('followerID');
            $table->unsignedBigInteger('followingID');
            $table->foreign('followerID')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('followingID')->references('id')->on('users')->onDelete('cascade');
            $table->primary(["followerID", "followingID"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
