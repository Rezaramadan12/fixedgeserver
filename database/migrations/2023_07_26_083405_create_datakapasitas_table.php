<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatakapasitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datakapasitas', function (Blueprint $table) {
            $table->id();
            $table->integer('volumeorganik');
            $table->integer('volumenonorganik');
            $table->integer('volumeB3');
            $table->float('volumetotaledge');
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
        Schema::dropIfExists('datakapasitas');
    }
}
