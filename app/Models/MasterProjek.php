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
        'project_name',
        'code_project',
        'deadline',
        'start',
        'end',
    ];

    protected $dates = ['deadline', 'start', 'end'];
}
