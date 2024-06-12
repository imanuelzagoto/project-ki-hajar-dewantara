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
            $table->integer('user_id');
            $table->string('project')->nullable();
            $table->string('code')->nullable();
            $table->string('nama_pemohon');
            $table->string('jabatan_pemohon');
            $table->text('pemeriksa');
            $table->text('persetujuan');
            $table->string('subject');
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
