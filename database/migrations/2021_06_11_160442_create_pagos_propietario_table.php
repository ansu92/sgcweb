<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosPropietarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_propietario', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->decimal('monto', 12);
            $table->date('fecha');
            $table->string('referencia', 8)->nullable();
            $table->enum('forma_pago', ['Efectivo', 'Transferencia', 'Depósito', 'Pago móvil', 'Cheque', 'Punto de venta']);
            $table->enum('moneda', ['Bolívar', 'Dólar',]);
            $table->foreignId('tasa_cambio_id')->nullable();
            $table->foreignId('cuenta_id')->nullable();
            $table->foreignId('unidad_id');
            $table->foreignId('factura_id');
            $table->enum('estado', ['Por confirmar', 'Confirmado'])->nullable()->default('Por confirmar');
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
        Schema::dropIfExists('pagos_propietario');
    }
}
