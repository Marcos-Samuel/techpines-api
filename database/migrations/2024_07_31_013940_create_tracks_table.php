<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('tracks', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('album_name')->nullable();
        $table->string('duration')->nullable();
        $table->string('music_url')->nullable();
        $table->foreignId('album_id')->constrained('albums')->onDelete('cascade');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};
