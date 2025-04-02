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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->longText('video_url');
            $table->string('thumbnail_url')->nullable();
            $table->integer('duration')->nullable()->comment('Duration in seconds');
            $table->boolean('is_published')->default(true);
            
            $table->integer('popup_seconds_before_end')->default(10)->comment('Seconds before video ends');
            $table->nullableMorphs('popup'); // creates popup_type and popup_id by polymorphic relationship
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
