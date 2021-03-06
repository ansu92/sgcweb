<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('unidades', function (Blueprint $table) {
			$table->id();
			$table->string('numero')->unique();
			$table->string('direccion');
			$table->foreignId('tipo_unidad_id')->constrained('tipo_unidades');
			$table->foreignId('propietario_id')->nullable()/* ->constrained() */;
			$table->string('documento', 20)->nullable()->unique();
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
		Schema::dropIfExists('unidades');
	}
}
