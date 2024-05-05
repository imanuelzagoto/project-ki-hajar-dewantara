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
        Schema::create('item_pengajuan_danas', function (Blueprint $table) {
            $table->unsignedBigInteger('pengajuan_dana_id');
            $table->string('nama_item');
            $table->unsignedInteger('jumlah');
            $table->string('satuan');
            $table->unsignedBigInteger('harga');
            $table->unsignedBigInteger('total');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('pengajuan_dana_id')->references('id')->on('pengajuan_danas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_pengajuan_danas');
    }
};
