<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctors')->insert([
            'name' => 'Dr. Roberto Salinas Vega',
            'email' => 'roberto.salinas@clinica.com',
            'phone' => '9711000001',
            'specialty' => 'Cardiología',
            'license_number' => 'CED-1001',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('doctors')->insert([
            'name' => 'Dra. Laura Méndez Ortiz',
            'email' => 'laura.mendez@clinica.com',
            'phone' => '9711000002',
            'specialty' => 'Pediatría',
            'license_number' => 'CED-1002',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('doctors')->insert([
            'name' => 'Dr. Jorge Castillo Ruiz',
            'email' => 'jorge.castillo@clinica.com',
            'phone' => '9711000003',
            'specialty' => 'Medicina General',
            'license_number' => 'CED-1003',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
