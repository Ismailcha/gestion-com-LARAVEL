<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatevisiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visite', function (Blueprint $table) {
            $table->id();
            $table->string("Identifiant");
            $table->date("Date");
            $table->integer("Duree");
            $table->string("Observation");
            $table->foreignId('NumClient')->constrained('client', 'NumClient')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('commercial_id')->constrained('commerciaux', 'IDDelegue')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('visite');
    }
}
