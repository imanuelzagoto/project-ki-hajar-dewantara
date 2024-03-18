<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MasterProjek extends Model
{
    use HasFactory;

    protected $table = 'master_projeks';

    protected $fillable = [
        'nama_project',
        'kode_project',
        'tenggat',
        'mulai',
        'akhir',
    ];

    protected $dates = ['tenggat', 'mulai', 'akhir'];
}
