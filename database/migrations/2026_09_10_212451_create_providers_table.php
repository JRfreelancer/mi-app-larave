<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crear la tabla de proveedores.
     */
    public function up(): void
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100);
            $table->string('contact', 100)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('address', 200)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Eliminar la tabla de proveedores.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
