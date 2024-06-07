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
        Schema::create('work_order_details', function (Blueprint $table) {
            $table->unsignedBigInteger('surat_perintah_kerja_id');
            $table->string('job_type');
            $table->text('job_description');
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
        Schema::dropIfExists('work_order_details');
    }
};
