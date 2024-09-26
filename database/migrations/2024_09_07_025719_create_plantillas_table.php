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
        Schema::create('plantillas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade'); // Relación con Categorías
            $table->string('tipo_catalogo'); // Puede ser "con descripcion" o "sin descripcion"
            $table->string('imagen_1'); // URLs de las imágenes
            $table->string('imagen_2')->nullable();
            $table->string('imagen_3')->nullable();
            $table->string('imagen_4')->nullable();
            $table->string('imagen_5')->nullable();
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 8, 2)->nullable(); // Añadir campo precio
            $table->integer('numero_vistas')->nullable(); // Añadir campo número de vistas
            $table->string('enlace');
            $table->string('slug')->unique(); // Campo slug
            $table->boolean('estado')->default(true); // Campo estado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantillas');
    }
};
