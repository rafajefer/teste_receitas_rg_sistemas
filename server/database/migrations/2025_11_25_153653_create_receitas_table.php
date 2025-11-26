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
        Schema::create('receitas', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('id_usuarios');
            $table->unsignedBigInteger('id_categorias')->nullable(); 

            $table->string('nome', 45)->nullable();
            $table->unsignedInteger('tempo_preparo_minutos')->nullable();
            $table->unsignedInteger('porcoes')->nullable();
            $table->text('modo_preparo');
            $table->text('ingredientes')->nullable();

            $table->dateTime('criado_em');
            $table->dateTime('alterado_em');

            $table->index('id_usuarios', 'fk_receitas_1_idx');
            $table->index('id_categorias', 'fk_receitas_2_idx');

            $table->foreign('id_usuarios', 'fk_receitas_1')
                ->references('id')
                ->on('usuarios')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_categorias', 'fk_receitas_2')
                ->references('id')
                ->on('categorias')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receitas');
    }
};
