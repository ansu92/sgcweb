<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->enum('calculo_por', ['Alícuota', 'Total de inmuebles']);
            $table->string('mes_cobro');
            $table->enum('moneda', ['Bolívar', 'Dólar']);
            $table->decimal('monto');
            $table->text('observaciones')->nullable();
			$table->enum('estado', ['Por procesar', 'Procesado', 'Pagado'])->default('Por procesar');
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
        Schema::dropIfExists('gastos');
    }
}
