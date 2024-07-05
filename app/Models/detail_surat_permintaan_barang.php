<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_surat_permintaan_barang extends Model
{
    use HasFactory;
    protected $fillable = [
        'spesifikasi',
        'jumlah',
        'satuan',
        'keterangan',
    ];

    public function suratPerintahKerja()
    {
        return $this->belongsTo(Surat_perintah_kerja::class);
    }
}
