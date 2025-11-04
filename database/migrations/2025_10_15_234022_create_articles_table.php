<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('caracteristiques');
            $table->string('designation'); 
            $table->string('marque'); 
            $table->string('reference'); 
            $table->string('qtestock'); 
            $table->string('prixAchat'); 
            $table->string('prixVente'); 
            $table->string('prixSolde'); 
            $table->string('imageartpetitf'); 
            $table->string('imageartgrandf'); 

            // ✅ Nouvelle façon plus sûre de déclarer les clés étrangères
            $table->foreignId('categorieID')
                ->constrained('categories')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->foreignId('scategorieID')
                ->constrained('scategories')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
