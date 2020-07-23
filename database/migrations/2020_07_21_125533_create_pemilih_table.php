<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemilihTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemilih', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->unsignedBigInteger('periode');
            $table->foreign('periode')->references('id')->on('periode')->onDelete('cascade');
            $table->unsignedBigInteger('status');
            $table->foreign('status')->references('id')->on('status')->onDelete('cascade');
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
        Schema::dropIfExists('pemilih');
    }
}
