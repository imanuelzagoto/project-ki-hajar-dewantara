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
        Schema::create('detail_pengajuan_danas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_dana_id');
            $table->string('tujuan');
            $table->string('lokasi');
            $table->date('batas_waktu');
            $table->string('subtotal');
            $table->string('terbilang');
            $table->string('tunai')->nullable();
            $table->string('non_tunai')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('catatan')->nullable();
            $table->timestamps();

            $table->foreign('pengajuan_dana_id')->references('id')->on('pengajuan_danas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengajuan_danas');
    }
};
