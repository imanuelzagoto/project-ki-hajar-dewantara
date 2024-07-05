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
        'title',
        'user',
        'main_contractor',
        'project_manager',
        'no_spk',
        'submission_date',
        'priority',
        'completion_time',
        'pic',
        'job_type',
        'type_format_pekerjaan',
        'form_number',
    ];

    protected $dates = [
        'submission_date',
        'completion_time',
    ];

    public function getSubmissionDateAttribute($value)
    {
        // return Carbon::parse($value)->translatedFormat('d/m/y');
        // Check if the value is null
        if ($value === null) {
            return null;
        }
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function getCompletionTimeAttribute($value)
    {
        // Check if the value is null
        if ($value === null) {
            return null;
        }
        return Carbon::parse($value)->format('d-m-Y');
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => asset('/storage/posts/' . $image),
        );
    }

    protected function kontrak(): Attribute
    {
        return Attribute::make(
            get: fn ($kontrak) => asset('/storage/kontrak/' . $kontrak),
        );
    }

    protected function brosur(): Attribute
    {
        return Attribute::make(
            get: fn ($brosur) => asset('/storage/brosur/' . $brosur),
        );
    }

    public function approvals()
    {
        return $this->hasMany(ApprovalData::class);
    }

    public function details()
    {
        return $this->hasMany(DetailSuratPerintahKerja::class);
    }

    public function details_permintaan()
    {
        return $this->hasMany(detail_surat_permintaan_barang::class);
    }
}
