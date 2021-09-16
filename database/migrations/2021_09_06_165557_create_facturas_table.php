<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
			$table->decimal('monto', 12);
			$table->decimal('monto_por_pagar', 12);
			$table->enum('moneda', ['Bolívar', 'Dólar']);
			$table->decimal('tasa_cambio', 12);
			$table->date('fecha');
			$table->enum('estado', ['Pendiente', 'Pagada'])->default('Pendiente');
			$table->foreignId('gasto_id');
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
        Schema::dropIfExists('facturas');
    }
}
