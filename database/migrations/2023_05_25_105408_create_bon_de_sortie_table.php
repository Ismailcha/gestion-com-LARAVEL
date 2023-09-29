<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonDeSortieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon_de_sortie', function (Blueprint $table) {
            $table->id();
            $table->integer('commercial_id');
            $table->date('Date');
            $table->integer('TotalHT');
            $table->integer('client_id');
            $table->text('Observations');
            $table->foreignId('commercial_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('client_id')->references('NumClient')->on('client')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('bon_de_sortie');
    }
}
