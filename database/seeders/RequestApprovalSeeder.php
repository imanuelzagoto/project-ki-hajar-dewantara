<?php

namespace Database\Seeders;

use App\Models\RequestApproval;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequestApprovalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RequestApproval::create([
            'nama' => "Endar",
            'jabatan' => "PM Koordinator"
        ]);
        RequestApproval::create([
            'nama' => "Yani",
            'jabatan' => "GM"
        ]);
        RequestApproval::create([
            'nama' => "Bayu",
            'jabatan' => "GM"
        ]);
        RequestApproval::create([
            'nama' => "Sindu Irawan",
            'jabatan' => "BOD"
        ]);
        RequestApproval::create([
            'nama' => "Victor",
            'jabatan' => "BOD"
        ]);
        RequestApproval::create([
            'nama' => "Erwin Danuaji",
            'jabatan' => "BOD"
        ]);
    }
}
