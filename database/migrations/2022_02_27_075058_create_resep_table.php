<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resep', function (Blueprint $table) {
            $table->id('resep_id', 11);
            $table->string('transaction_id', 50)->nullable();
            $table->integer('obatalkes_id', false, false, 11)->nullable();
            $table->integer('signa_id', false, false, 11)->nullable();
            $table->integer('racikan_id', false, false, 11)->nullable();
            $table->string('obatalkes_nama', 250)->nullable();
            $table->string('obatalkes_kode', 100)->nullable();
            $table->integer('qty', false, false, 11)->nullable();
            $table->string('signa_nama', 250)->nullable();
            $table->string('signa_kode', 100)->nullable();
            $table->timestamp('tgl_resep')->nullable();
            $table->string('pasien_nama', 250)->nullable();
            $table->string('apoteker_nama', 250)->nullable();
            $table->string('dokter_nama', 250)->nullable();
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
        Schema::dropIfExists('resep');
    }
}
