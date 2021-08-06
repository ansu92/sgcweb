<?php

use App\Models\Proveedor;
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
            $table->decimal('monto', 12);
            $table->decimal('saldo', 12);
            $table->text('observaciones')->nullable();
            $table->foreignId('proveedor_id');
			$table->string('factura');
			$table->enum('estado', ['Pendiente', 'Pagado'])->default('Pendiente');
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
