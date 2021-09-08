<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_gastos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->decimal('monto', 12);
            $table->date('fecha');
            $table->string('recibo')->unique();
            $table->string('referencia', 8)->nullable();
			$table->enum('forma_pago', ['Efectivo', 'Transferencia', 'Depósito', 'Pago móvil', 'Cheque', 'Punto de venta']);
			$table->enum('moneda', ['Bolívar', 'Dólar',]);
			$table->decimal('tasa_cambio', 12)->nullable();
            $table->foreignId('gasto_id')->nullable();
            $table->foreignId('fondo_id')->nullable();
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
        Schema::dropIfExists('pagos_gastos');
    }
}
