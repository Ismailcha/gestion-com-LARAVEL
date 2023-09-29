<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommerciauxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commerciaux', function (Blueprint $table) {
            $table->id("IDDelegue");
            $table->string('nomDel');
            $table->string('CIN');
            $table->string('CNSSDel');
            $table->string('AdresseDel');
            $table->string('NumCaGrise');
            $table->string('NumPC');
            $table->string('Poste');
            $table->date('DateEmb');
            $table->string('Qualié');
            $table->string('Affecaions');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
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
        Schema::dropIfExists('commerciaux');
    }
}
