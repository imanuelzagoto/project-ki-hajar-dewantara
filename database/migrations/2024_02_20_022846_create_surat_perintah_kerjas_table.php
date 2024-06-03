<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations...
     */
    public function up(): void
    {
        Schema::create('surat_perintah_kerjas', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('code');
            $table->string('title');
            $table->string('user');
            $table->string('main_contractor');
            $table->string('project_manager');
            $table->string('no_spk');
            $table->date('submission_date');
            $table->string('priority');
            $table->date('completion_time')->nullable();
            $table->string('pic')->nullable();
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
