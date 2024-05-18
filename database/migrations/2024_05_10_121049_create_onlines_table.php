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
        Schema::create('onlines', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->string('price');
            $table->string('teacher');
            $table->string('hour');
            $table->string('student');
            $table->longText('desc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onlayns');
    }
};
