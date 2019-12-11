<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('genero',['M','F','O']);
            $table->enum('tipo_docu',['DNI','RUC','OTRO']);
            $table->string('nro_documento',16);
            $table->string('nombre',255);
            $table->string('apellido_paterno',255);
            $table->string('apellido_materno',255);
            $table->string('direccion',255)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('deleted_at')->nullable();
            $table->string('created_at')->nullable();
            $table->string('updated_at')->nullable();
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
