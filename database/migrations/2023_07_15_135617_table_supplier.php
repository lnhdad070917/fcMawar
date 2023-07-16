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
        Schema::create('supplier', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_supplier', 50);
            $table->string('no_nota', 25);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('suppiers');
    }
};