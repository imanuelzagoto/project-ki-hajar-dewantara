<?php

namespace Database\Seeders;

use App\Models\RequestApprovalSpk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestApprovalSpkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RequestApprovalSpk::create([
            'nama' => "Erwin Danuaji",
            'jabatan' => "BOD"
        ]);
        RequestApprovalSpk::create([
            'nama' => "Victor",
            'jabatan' => "BOD"
        ]);
        RequestApprovalSpk::create([
            'nama' => "Sindu Irawan",
            'jabatan' => "BOD"
        ]);
    }
}
