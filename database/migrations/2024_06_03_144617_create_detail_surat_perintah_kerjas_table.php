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
        Schema::create('detail_surat_perintah_kerjas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_perintah_kerja_id');
            $table->text('job_type');
            $table->text('job_description');
            $table->integer('supporting_document_type')->nullable()->default(1);
            $table->string('supporting_document_file')->nullable();
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('surat_perintah_kerja_id')->references('id')->on('surat_perintah_kerjas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_surat_perintah_kerjas');
    }
};
