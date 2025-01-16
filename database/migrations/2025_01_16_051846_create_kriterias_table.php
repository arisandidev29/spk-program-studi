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
        Schema::create('kriterias', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->text('desc');
            $table->unsignedBigInteger('bobot_id')->nullable(false);
            $table->unsignedBigInteger('category_id')->nullable(false);

            $table->foreign('bobot_id')->references('id')->on('bobots');
            $table->foreign('category_id')->references('id')->on('categoris');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriterias');
    }
};
