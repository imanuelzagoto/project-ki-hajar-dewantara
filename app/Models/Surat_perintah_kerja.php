<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surat_perintah_kerja extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_project',
        'nama_project',
        'user',
        'main_contractor',
        'project_manager',
        'no_spk',
        'tanggal',
        'prioritas',
        'waktu_penyelesaian',
        'dokumen_pendukung_type',
        'dokumen_pendukung_file',
        'file_pendukung_lainnya',
    ];

    /**
     * image
     *
     * @return Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => asset('/storage/posts/' . $image),
        );
    }

    /**
     * kontrak
     *
     * @return Attribute
     */
    protected function kontrak(): Attribute
    {
        return Attribute::make(
            get: fn ($kontrak) => asset('/storage/kontrak/' . $kontrak),
        );
    }

    /**
     * brosur
     *
     * @return Attribute
     */
    protected function brosur(): Attribute
    {
        return Attribute::make(
            get: fn ($brosur) => asset('/storage/brosur/' . $brosur),
        );
    }
}
