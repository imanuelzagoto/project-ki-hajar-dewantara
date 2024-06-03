<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DetailPengajuanDana extends Model
{
    use HasFactory;
    protected $fillable = [
        'tujuan',
        'lokasi',
        'batas_waktu',
        'subtotal',
        'terbilang',
        'tunai',
        'non_tunai',
        'nama_bank',
        'catatan',
    ];

    public function pengajuanDana()
    {
        return $this->belongsTo(PengajuanDana::class);
    }
}
