<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('ci')->unique();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('celular')->nullable();
            $table->string('correo')->nullable()->unique();
            $table->text('direccion')->nullable();
            $table->string('grupo_sanguineo')->nullable();
            $table->string('contacto_emergencia')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
