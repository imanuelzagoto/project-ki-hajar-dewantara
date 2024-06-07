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
        RequestApproval::insert([
            [
                'nama' => "Endar",
                'jabatan' => "PM Koordinator"
            ],
            [
                'nama' => "Yani",
                'jabatan' => "GM"
            ],
            [
                'nama' => "Bayu",
                'jabatan' => "GM"
            ],
            [
                'nama' => "Sindu Irawan",
                'jabatan' => "BOD"
            ],
            [
                'nama' => "Victor",
                'jabatan' => "BOD"
            ], [
                'nama' => "Erwin Danuaji",
                'jabatan' => "BOD"
            ]
        ]);

        // DB::table('request_approvals')->insert([
        //     [
        //         'nama' => 'Endar',
        //         'jabatan' => 'PM Koordinator',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nama' => 'Yani',
        //         'jabatan' => 'GM',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nama' => 'Bayu',
        //         'jabatan' => 'GM',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nama' => 'Sindu Irawan',
        //         'jabatan' => 'BOD',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nama' => 'Victor',
        //         'jabatan' => 'BOD',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nama' => 'Erwin Danuaji',
        //         'jabatan' => 'BOD',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);
    }
}
