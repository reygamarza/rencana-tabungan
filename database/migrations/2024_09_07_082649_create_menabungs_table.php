<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menabungs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tabungan');
            $table->foreign('id_tabungan')->references('id')->on('tabungans');
            $table->integer('nominal');
            $table->date('tanggal_menabung');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menabungs');
    }
};
