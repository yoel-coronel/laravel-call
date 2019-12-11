<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDireccionClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccion_clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cliente_id');
            $table->enum('tipo_direccion',['R','F']);
            $table->string('nom_tipo_direccion',100);
            $table->string('urb_resid',20);
            $table->string('nom_urb_resid',100);
            $table->string('direccion_envio',255);
            $table->string('av_jr_calle',20);
            $table->string('name_av_jr_calle',100);
            $table->string('nombre_av_jr_calle',200);
            $table->string('numero',100);
            $table->string('manzana',100);
            $table->string('lote',100);
            $table->enum('dto_piso',['N','P','D','C']);
            $table->string('name_dto_piso');
            $table->boolean('is_activo')->default(1);
            $table->string('created_at')->nullable();
            $table->string('updated_at')->nullable();
            $table->string('deleted_at')->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('direccion_clientes');
    }
}
