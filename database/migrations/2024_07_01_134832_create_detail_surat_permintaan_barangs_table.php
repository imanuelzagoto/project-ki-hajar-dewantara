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
        Schema::create('detail_surat_permintaan_barangs', function (Blueprint $table) {
            $table->unsignedBigInteger('surat_perintah_kerja_id');
            $table->text('spesifikasi')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('satuan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->foreign('surat_perintah_kerja_id')->references('id')->on('surat_perintah_kerjas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_surat_permintaan_barangs');
    }
};
