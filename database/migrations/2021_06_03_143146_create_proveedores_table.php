<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->enum('letra', ['V', 'E', 'J']);
            $table->string('documento', 12);
            $table->string('nombre', 60);
            $table->string('contacto', 45);
            $table->string('telefono', 12);
            $table->string('email', 45)->nullable()->unique();
            $table->string('direccion')->nullable();

			$table->unique(['letra', 'documento'], 'documento');

            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
}
