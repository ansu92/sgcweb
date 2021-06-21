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
            $table->decimal('monto');
            $table->date('fecha');
            $table->string('ref');
            $table->foreignId('gasto_id');
            $table->foreignId('fondo_id');
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
        Schema::dropIfExists('pagos_gastos');
    }
}
