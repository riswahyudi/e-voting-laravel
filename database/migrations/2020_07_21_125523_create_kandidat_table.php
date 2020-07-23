<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKandidatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kandidat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama',100);
            $table->text('visi');
            $table->text('misi');
            $table->string('gambar');
            $table->unsignedBigInteger('periode');
            $table->foreign('periode')->references('id')->on('periode')->onDelete('cascade');
            $table->timestamps();
            $table->bigInteger('jumlah_suara');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kandidat');
    }
}
