<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description'); // Agregado el campo description
            $table->decimal('price', 8, 2);
            $table->unsignedBigInteger('space_id'); // Relación con el espacio
            $table->timestamps();

            // Establecer la clave foránea
            $table->foreign('space_id')->references('id')->on('spaces')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
}
