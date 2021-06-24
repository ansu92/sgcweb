<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntegrantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integrantes', function (Blueprint $table) {
            $table->id();
            $table->string('documento', 12)->unique();
            $table->string('nombre', 20);
            $table->string('s_nombre', 20)->nullable();
            $table->string('apellido', 20);
            $table->string('s_apellido', 20)->nullable();
            $table->string('telefono', 12)->nullable();
            $table->string('email', 45)->nullable()->unique();
            $table->string('direccion');

            $table->foreignId('unidad_id');
			
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('integrantes');
    }
}
