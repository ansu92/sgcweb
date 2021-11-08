<?php

use App\Models\Unidad;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntegrantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integrantes', function (Blueprint $table) {
            $table->id();
            $table->enum('letra', ['V', 'E'])->nullable();
            $table->string('documento', 10)->nullable();
            $table->string('nombre', 20);
            $table->string('s_nombre', 20)->nullable();
            $table->string('apellido', 20);
            $table->string('s_apellido', 20)->nullable();
            $table->date('fecha_nacimiento');
            $table->string('telefono', 12)->nullable();
            $table->string('email', 45)->nullable()->unique();
            $table->foreignId('unidad_id')->nullable();

            $table->unique(['letra', 'documento']);

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
        Schema::dropIfExists('integrantes');
    }
}
