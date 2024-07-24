<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\RequestApproval;
use App\Models\RequestApprovalSpk;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([UserSeeder::class]);

        if (RequestApproval::count() == 0); {
            $this->call(RequestApprovalSeeder::class);
        }

        if (RequestApprovalSpk::count() == 0) {
            $this->call(RequestApprovalSpkSeeder::class);
        }
    }
}
