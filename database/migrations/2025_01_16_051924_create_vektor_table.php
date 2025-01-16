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
        Schema::disableForeignKeyConstraints();
        Schema::create('vektor', function (Blueprint $table) {
            $table->id();
            $table->double('nilai_s')->nullable(false);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('alternative_id');
             $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('alternative_id')->references('id')->on('alternatives');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vektor');
    }
};
