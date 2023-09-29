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
        Schema::create('bande_commande_produits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bon_de_sortie_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantite');
            $table->foreign('bon_de_sortie_id')->references('id')->on('bon_de_sortie')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('produit')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bande_commande_produits');
    }
};
