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
        Schema::create('scategories', function (Blueprint $table) {
            $table->id(); // ✅ Ajoute un ID auto-incrémenté
            $table->string('nomscategorie');
            $table->string('imagescat');
            $table->unsignedBigInteger('categorieID');
            $table->foreign('categorieID')
                ->references('id')
                ->on('categories')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->timestamps(); // ✅ (optionnel mais recommandé)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scategories');
    }
};
