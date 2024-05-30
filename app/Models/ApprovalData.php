<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalData extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_name',
        'receiver_name',
        'approver_name',
        'board_of_directors',
        'applicant_position',
        'receiver_position',
        'approver_position',
        'position',
    ];

    /**
     * Get the surat perintah kerja that owns the aprroval.
     */
    public function suratPerintahKerja()
    {
        return $this->belongsTo(Surat_perintah_kerja::class, 'surat_perintah_kerja_id');
    }
}
