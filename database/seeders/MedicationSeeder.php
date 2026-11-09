<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('medications')->insert([
            'name' => 'Paracetamol',
            'description' => 'Analgésico y antipirético para dolor y fiebre.',
            'presentation' => 'Tableta 500mg',
            'price' => 45.50,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('medications')->insert([
            'name' => 'Ibuprofeno',
            'description' => 'Antiinflamatorio para dolor muscular.',
            'presentation' => 'Tableta 400mg',
            'price' => 62.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('medications')->insert([
            'name' => 'Amoxicilina',
            'description' => 'Antibiótico para infecciones bacterianas.',
            'presentation' => 'Jarabe 120ml',
            'price' => 98.75,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('medications')->insert([
            'name' => 'Losartán',
            'description' => null,
            'presentation' => 'Tableta 50mg',
            'price' => 120.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
