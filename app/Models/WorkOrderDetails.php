<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrderDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_type',
        'job_description',
    ];

    /**
     * Get the surat perintah kerja that owns the aprroval.
     */
    public function suratPerintahKerja()
    {
        return $this->belongsTo(Surat_perintah_kerja::class, 'surat_perintah_kerja_id');
    }
}
