<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSpk extends Model
{
    use HasFactory;

    protected $table = 'job_spks';

    protected $fillable = [
        'jenis_pekerjaan',
        'uraian_pekerjaan',
        'tanggal',
        'jam',
    ];

    // Getter untuk mengubah format tanggal
    public function getTanggalAttribute($value)
    {
        return date('j F Y', strtotime($value));
    }

    // Getter untuk mengubah format jam
    public function getJamAttribute($value)
    {
        $jam = date('G', strtotime($value));
        $jamFormat = date('g', strtotime($value));

        if ($jam >= 12 && $jam < 18) {
            return $jamFormat . " Siang";
        } else {
            return "Malam";
        }
    }
}
