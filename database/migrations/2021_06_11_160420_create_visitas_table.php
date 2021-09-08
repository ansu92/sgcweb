<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
			$table->enum('letra', ['V', 'E']);
            $table->string('ci', 8);
            $table->string('nombre', 45);
            $table->string('apellido', 45);
            $table->foreignId('unidad_id');
            $table->integer('numero_personas')->nullable();
            $table->timestamp('fecha_hora_entrada')->default(now());
            $table->timestamp('fecha_hora_salida')->nullable();
            $table->string('matricula', 7)->nullable();
            $table->string('marca', 25)->nullable();
            $table->string('modelo', 25)->nullable();
            $table->string('color')->nullable();
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
        Schema::dropIfExists('visitas');
    }
}
