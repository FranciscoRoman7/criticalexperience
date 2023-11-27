<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tirada_dados', function (Blueprint $table) {
            $table->id();
            $table->string('email_usuario');
            $table->foreign('email_usuario')
                ->references('email')
                ->on('users')
                ->onDelete('cascade');
            $table->integer('tipo_dado');
            $table->integer('bonificador');
            $table->integer('resultado');
            $table->integer('total')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tirada_dados');
    }
};
