<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigneDeBonDeSortieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_de_bon_de_sortie', function (Blueprint $table) {
            $table->id();
            $table->integer('NumBS');
            $table->string('ReferenceProduit');
            $table->string('LibProd');
            $table->integer('Quantite');
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
        Schema::dropIfExists('ligne_de_bon_de_sortie');
    }
}
