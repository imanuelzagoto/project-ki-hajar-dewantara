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
        Schema::create('master_projeks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_project');
            $table->string('kode_project');
            $table->date('tenggat')->nullable();
            $table->date('mulai')->nullable();
            $table->date('akhir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_projeks');
    }
};
