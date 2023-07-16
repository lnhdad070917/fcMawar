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
        Schema::create('item_supplier', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_supplier')->unsigned();
            $table->foreign('id_supplier')->references('id')->on('supplier');
            $table->unsignedBigInteger('id_barang')->unsigned();
            $table->foreign('id_barang')->references('id')->on('barang');
            $table->integer('total_kertas');
            $table->integer('harga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('item_supplier');
    }
};