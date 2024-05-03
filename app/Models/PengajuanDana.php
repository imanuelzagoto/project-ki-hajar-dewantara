<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PengajuanDana extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pemohon',
        'jabatan_pemohon',
        'subject',
        'tujuan',
        'lokasi',
        'batas_waktu',
        'subtotal',
        // 'total',
        'terbilang',
        'metode_penerimaan',
        'catatan',
        'tanggal_pengajuan',
        'no_doc',
        'revisi',
        'form_number'
    ];

    protected $dates = [
        'tanggal_pengajuan',
        'batas_waktu',
    ];

    /**
     * Get the formatted tanggal attribute.
     *
     * @param  string  $value
     * @return string
     */
    public function getTanggalAttribute($value)
    {
        return Carbon::parse($value)->translatedFormat('d F Y');
    }

    /**
     * Get the formatted jangka_waktu attribute.
     *
     * @param  string  $value
     * @return string
     */
    public function getJangkaWaktuAttribute($value)
    {
        // Check if the value is null
        if ($value === null) {
            return null;
        }
        return Carbon::parse($value)->translatedFormat('d F Y');
    }

    public function items()
    {
        return $this->hasMany(ItemPengajuanDana::class);
    }
}
