<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PengajuanDana extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_pemohon',
        'jabatan_pemohon',
        'subject',
        'tanggal_pengajuan',
        'no_doc',
        'revisi',
        'form_number'
    ];

    protected $dates = [
        'tanggal_pengajuan',
        'batas_waktu',
    ];

    public function getTanggalPengajuanAttribute($value)
    {
        return Carbon::parse($value)->translatedFormat('d/m/y');
    }

    public function getBatasWaktuAttribute($value)
    {
        // Check if the value is null
        if ($value === null) {
            return null;
        }
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function items()
    {
        return $this->hasMany(ItemPengajuanDana::class);
    }

    public function details()
    {
        return $this->hasMany(DetailPengajuanDana::class);
    }
}
