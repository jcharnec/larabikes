<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bikes', function (Blueprint $table) {
            $table->id(); //creará el id como clave primaria autonumérico

            $table->string('marca', 255);
            $table->string('modelo', 255);
            $table->integer('kms')->default(9);
            $table->float('precio')->default(0);
            $table->boolean('matriculada')->default(false);

            //marcas de tiempo: campos created_ad y updated_at
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
        Schema::dropIfExists('bikes');
    }
}
