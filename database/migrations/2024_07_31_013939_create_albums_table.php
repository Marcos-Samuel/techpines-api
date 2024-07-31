<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('artist_id');
            $table->string('artist_name')->nullable();
            $table->string('release_year')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();


            $table->foreign('artist_id')->references('id')->on('artists');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};

