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
			$table->string('numero')->unique();
			$table->decimal('monto', 12);
			$table->decimal('monto_por_pagar', 12);
			$table->enum('moneda', ['Bolívar', 'Dólar']);
			$table->date('fecha');
			$table->foreignId('unidad_id')->constrained('unidades');
			$table->foreignId('iva_id')->constrained();
			$table->foreignId('interes_id')->nullable()->constrained('intereses');
			$table->foreignId('cierre_mes_id')->nullable()->constrained('cierres_mes');
			$table->foreignId('tasa_cambio_id')->constrained('tasas_cambio');
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
