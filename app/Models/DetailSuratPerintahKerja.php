<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSuratPerintahKerja extends Model
{
    use HasFactory;
    protected $fillable = [
        'supporting_document_type',
        'supporting_document_file',
    ];

    public function suratPerintahKerja()
    {
        return $this->belongsTo(Surat_perintah_kerja::class);
    }
}
