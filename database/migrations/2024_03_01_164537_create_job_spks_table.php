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
        Schema::create('job_spks', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_pekerjaan')->nullable();
            $table->string('uraian_pekerjaan')->nullable();
            $table->date('tanggal')->nullable();
            $table->time('jam')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_spks');
    }
};
