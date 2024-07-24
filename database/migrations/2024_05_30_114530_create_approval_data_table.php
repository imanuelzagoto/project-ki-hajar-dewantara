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
        Schema::create('approval_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_perintah_kerja_id');
            $table->string('applicant_name');
            $table->string('receiver_name')->nullable();
            $table->string('approver_name');
            $table->text('board_of_directors');
            $table->string('applicant_position');
            $table->string('receiver_position')->nullable();
            $table->string('approver_position');
            $table->string('position');
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
        Schema::dropIfExists('approval_data');
    }
};
