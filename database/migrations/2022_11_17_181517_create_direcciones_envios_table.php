<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDireccionesEnviosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direcciones_envios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('direccion', 140);
            $table->string('nombreCalle', 85);
            $table->integer('portal');
            $table->string('piso', 20);
            $table->integer('codigoPostal');
            $table->string('ciudad', 60);
            $table->string('provincia', 80);
            $table->string('pais', 70);
            $table->string('telefono', 10)->unique();
            $table->string('observaciones', 120);
            $table->unsignedBigInteger('empresa_reparto_id');
            $table->foreign('empresa_reparto_id')->references('id')->on('empresas_repartos')->onDelete('cascade');
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('deleted')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('direcciones_envios');
    }
}
