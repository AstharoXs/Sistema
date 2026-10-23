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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nom_producto');
            $table->string('detalle_producto');
            $table->integer('cant_producto');
            $table->decimal('valor_producto');
            $table->string('foto_producto');
            $table->enum('estado_producto', ['activo', 'inactivo'])->default('activo');
            $table->foreignId('id_categoria')->constrained('categorias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
