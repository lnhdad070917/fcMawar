<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_pembayaran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('tgl_transaksi');
            $table->string('ket', 1024);
            $table->timestamps();
        });

        Schema::create('item_transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_transaksi');
            $table->unsignedBigInteger('id_barang');
            $table->integer('jml_barang');
            $table->timestamps();

            $table->foreign('id_transaksi')->references('id')->on('transaksi_pembayaran')->onDelete('cascade');
            $table->foreign('id_barang')->references('id')->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_transaksi');
        Schema::dropIfExists('transaksi_pembayaran');
    }
};