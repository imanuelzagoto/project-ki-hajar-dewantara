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
        Schema::create('pengajuan_danas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon');
            $table->string('jabatan_pemohon');
            $table->string('subject');
            $table->string('tujuan');
            $table->string('lokasi');
            $table->date('batas_waktu');
            $table->decimal('subtotal', 15, 2);
            $table->string('terbilang');
            $table->string('metode_penerimaan');
            $table->string('catatan')->nullable();
            $table->date('tanggal_pengajuan');
            $table->string('no_doc');
            $table->string('revisi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_danas');
    }
};
