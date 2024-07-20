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
        'division_id',
        'project',
        'code',
        'nama_pemohon',
        'jabatan_pemohon',
        'pemeriksa',
        'persetujuan',
        'subject',
        'tanggal_pengajuan',
        'no_doc',
        'revisi',
        'project_manager',
        'form_number'
    ];

    protected $dates = [
        'tanggal_pengajuan',
        'batas_waktu',
    ];

    public function getTanggalPengajuanAttribute($value)
    {
        //  Check if the value is null
        if ($value === null) {
            return null;
        }
        return Carbon::parse($value)->format('d-m-Y');
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

    // public function requestapproval()
    // {
    //     return $this->hasMany(RequestApproval::class);
    // }
}
