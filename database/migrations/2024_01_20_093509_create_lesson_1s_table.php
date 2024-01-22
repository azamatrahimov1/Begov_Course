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
        Schema::create('lesson_1s', function (Blueprint $table) {
            $table->id();
            $table->string('name_video');
            $table->text('video');
            $table->string('name_image');
            $table->text('image');
            $table->text('voice');
            $table->text('pdf');
            $table->longText('homework');
            $table->longText('answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_1s');
    }
};
