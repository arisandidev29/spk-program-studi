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
        Schema::create('hasils', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->unsignedBigInteger('alternative_id')->nullable(false);
            $table->unsignedBigInteger('vektor_id')->nullable(false);
            $table->double('nilai_s');
            $table->double('nilai_preferensi');
            $table->timestamps();

            $table->foreign('vektor_id')->references('id')->on('vektor');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('alternative_id')->references('id')->on('alternatives');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasils');
    }
};
