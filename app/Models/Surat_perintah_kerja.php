<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Surat_perintah_kerja extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'code',
        'pemohon',
        'penerima',
        'menyetujui',
        'jabatan_1',
        'jabatan_2',
        'jabatan_3',
        'title',
        'user',
        'main_contractor',
        'project_manager',
        'no_spk',
        'tanggal',
        'prioritas',
        'waktu_penyelesaian',
        'pic',
        'jenis_pekerjaan',
        'uraian_pekerjaan',
        'dokumen_pendukung_type',
        'dokumen_pendukung_file',
        'file_pendukung_lainnya',
        'form_number',
    ];

    protected $dates = [
        'tanggal',
        'waktu_penyelesaian',
    ];

    /**
     * Get the formatted tanggal attribute.
     *
     * @param  string  $value
     * @return string
     */
    public function getTanggalAttribute($value)
    {
        return Carbon::parse($value)->translatedFormat('d/m/y');
    }

    /**
     * Get the formatted waktu_penyelesaian attribute.
     *
     * @param  string  $value
     * @return string
     */
    public function getWaktuPenyelesaianAttribute($value)
    {
        // Check if the value is null
        if ($value === null) {
            return null;
        }

        // Parse the value and return the date part only
        return Carbon::parse($value)->translatedFormat('d/m/y');
    }

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
