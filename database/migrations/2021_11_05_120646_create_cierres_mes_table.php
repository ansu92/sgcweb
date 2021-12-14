<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCierresMesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cierres_mes', function (Blueprint $table) {
            $table->id();
            $table->string('mes')->unique();
            $table->string('moneda');
            $table->foreignId('tasa_cambio_id')->constrained('tasas_cambio');
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
        Schema::dropIfExists('cierres_mes');
    }
}
