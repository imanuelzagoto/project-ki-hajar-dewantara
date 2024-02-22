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
        'subject',
        'tujuan',
        'lokasi',
        'jangka_waktu',
        'dana_yang_dibutuhkan',
        'no_rekening',
        'catatan',
        'tanggal',
        'no_doc',
        'revisi',
    ];

    protected $dates = [
        'tanggal',
        'jangka_waktu',
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
}
