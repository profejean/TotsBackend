<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpaceImagesTable extends Migration
{
    public function up()
    {
        Schema::create('space_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('space_id')->constrained()->onDelete('cascade');
            $table->string('url'); // URL de la imagen
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('space_images');
    }
}
