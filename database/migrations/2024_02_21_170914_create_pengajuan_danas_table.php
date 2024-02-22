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
            $table->string('subject');
            $table->string('tujuan');
            $table->string('lokasi');
            $table->date('jangka_waktu');
            $table->decimal('dana_yang_dibutuhkan', 15, 2);
            $table->string('no_rekening');
            $table->string('catatan')->nullable();
            $table->date('tanggal');
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
