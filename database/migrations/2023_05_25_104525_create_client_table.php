<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->id("NumClient");
            $table->string('Pharmacie');
            $table->integer('CodePostal');
            $table->string('NomClient');
            $table->string('Prénom');
            $table->string('Adresse');
            $table->string('Ville');
            $table->string('Pays');
            $table->integer('Telephone');
            $table->integer('Fax');
            $table->string('EMail');
            $table->string('Type');
            $table->string('Observations');
            $table->string('Plan');
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
        Schema::dropIfExists('client');
    }
}
