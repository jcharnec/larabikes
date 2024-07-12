<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_data', function (Blueprint $table) {
            $table->id();
            $table->string('movil', 16);
            $table->string('fijo', 16);
            $table->string('direccion', 255);
            $table->unsignedBigInteger('user_id')->unique();
            $table->timestamps();
            // relacionada con la tabla usuario
            $table->foreign('user_id')->references('id')->on('users')
                ->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_data', function(Blueprint $table){
            $table->dropForeign('contact_data_user_id_foreign');
        });
        Schema::dropIfExists('contact_data');
    }
}
