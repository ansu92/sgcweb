<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->enum('tipo', ['Corriente', 'Ahorro']);
            $table->string('documento', 12);
            $table->string('beneficiario', 45);
            $table->foreignId('banco_id')->constrained();
            $table->string('telefono', 12)->nullable();
            $table->boolean('publica')->default(false);
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
        Schema::dropIfExists('cuentas');
    }
}
