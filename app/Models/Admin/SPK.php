<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class SPK extends Model
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
        'pic',
        'dokumen_pendukung_type',
        'dokumen_pendukung_file',
        'file_pendukung_lainnya',
    ];

    protected $dates = [
        'tanggal',
        'waktu_penyelesaian',
    ];
}
