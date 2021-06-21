<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosFondosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_fondos', function (Blueprint $table) {
            $table->id();
            $table->decimal('monto');
            $table->string('descripcion');
            $table->date('fecha');
            $table->string('ref');
            $table->foreignId('fondo_id');
            $table->foreignId('unidad_id');
            $table->foreignId('cuenta_id');
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
        Schema::dropIfExists('pagos_fondos');
    }
}
