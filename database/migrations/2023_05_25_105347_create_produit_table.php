<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit', function (Blueprint $table) {
            $table->id();
            $table->string('Reference');
            $table->integer('Numserie');
            $table->string('LibProd');
            $table->integer('NumFournisseur');
            $table->string('CodeBarre');
            $table->string('Photo');
            $table->integer('PrixHT');
            $table->integer('PrixAchatHT');
            $table->integer('PPCTTC');
            $table->integer('PPHTTC');
            $table->integer('PGTTC');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produit');
    }
}
