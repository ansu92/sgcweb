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
			$table->date('fecha');
			$table->foreignId('unidad_id');
			$table->foreignId('iva_id');
			$table->enum('estado', ['Pendiente', 'Pagada'])->default('Pendiente');
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
