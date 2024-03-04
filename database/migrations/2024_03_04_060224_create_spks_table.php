<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_p_ks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_project');
            $table->string('nama_project');
            $table->string('user');
            $table->string('main_contractor');
            $table->string('project_manager');
            $table->string('no_spk');
            $table->date('tanggal');
            $table->integer('prioritas');
            $table->date('waktu_penyelesaian')->nullable();
            $table->string('pic');
            $table->string('dokumen_pendukung_type');
            $table->string('dokumen_pendukung_file');
            $table->string('file_pendukung_lainnya')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_p_ks');
    }
};
