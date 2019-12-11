<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiendaApisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tienda_apis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tienda_id',10);
            $table->string('api_token',255);
            $table->string('nombre',255);
            $table->string('url_api',255)->nullable();
            $table->string('message',255)->nullable();
            $table->boolean('estado')->default(1);
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
        Schema::dropIfExists('tienda_apis');
    }
}
