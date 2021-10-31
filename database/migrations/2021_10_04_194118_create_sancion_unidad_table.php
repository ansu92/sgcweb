<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSancionUnidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sancion_unidad', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->default(now());
            $table->foreignId('unidad_id');
            $table->foreignId('sancion_id');
            $table->decimal('monto_pagar');

            $table->enum('estado', ['Por procesar', 'Procesada'])->default('Por procesar');
            
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
        Schema::dropIfExists('sancion_unidad');
    }
}
