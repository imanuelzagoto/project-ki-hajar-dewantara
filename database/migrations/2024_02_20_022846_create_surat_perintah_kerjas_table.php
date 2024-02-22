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
        Schema::create('surat_perintah_kerjas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_project');
            $table->string('nama_project');
            $table->string('user');
            $table->string('main_contractor');
            $table->string('project_manager');
            $table->string('no_spk');
            $table->date('tanggal');
            $table->string('prioritas')->nullable();
            $table->date('waktu_penyelesaian')->nullable();
            $table->string('pic');
            $table->integer('dokumen_pendukung_type')->nullable()->default(1); // 1 = gambar, 2 = kontrak, 3 = brosur
            $table->string('dokumen_pendukung_file')->nullable(); // 1 = gambar, 2 = kontrak, 3 = brosur
            $table->string('file_pendukung_lainnya')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_perintah_kerjas');
    }
};
