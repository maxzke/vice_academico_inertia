<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cuerpo_academico_proyecto', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('proyecto_id');
            $table->foreign('proyecto_id')->references('id')->on('proyectos');
            $table->foreignId('cuerpo_academico_id');
            $table->foreign('cuerpo_academico_id')->references('id')->on('cuerpos_academicos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuerpo_academico_proyecto');
    }
};
