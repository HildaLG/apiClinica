<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsuranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('insurances')->insert([
            'name' => 'ISSTE',
            'code' => 'GNP-001',
            'phone' => '8000000001',
            'coverage_percentage' => 80,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('insurances')->insert([
            'name' => 'IMSS',
            'code' => 'AXA-001',
            'phone' => '8000000002',
            'coverage_percentage' => 70,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('insurances')->insert([
            'name' => 'Seguro Popular Plus',
            'code' => 'SPP-001',
            'phone' => '8000000003',
            'coverage_percentage' => 50,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
