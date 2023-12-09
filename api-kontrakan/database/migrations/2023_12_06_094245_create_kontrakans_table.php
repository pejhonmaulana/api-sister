<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontrakansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontrakans', function (Blueprint $table) {
            $table->id();
            $table->string('alamat_kontrakan');
            $table->string('jumlah_kamar_tidur');
            $table->string('jumlah_kamar_mandi');
            $table->string('fasilitas');
            $table->string('harga');
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
        Schema::dropIfExists('kontrakans');
    }
}
