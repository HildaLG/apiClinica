<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicationPatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('medication_patient')->insert([
            'patient_id' => 1,
            'medication_id' => 1,
            'dosage' => '500 mg',
            'frequency' => 'cada 8 horas',
            'start_date' => '2026-10-20',
            'end_date' => '2026-10-27',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('medication_patient')->insert([
            'patient_id' => 1,
            'medication_id' => 2,
            'dosage' => '400 mg',
            'frequency' => 'cada 12 horas',
            'start_date' => '2026-10-20',
            'end_date' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('medication_patient')->insert([
            'patient_id' => 2,
            'medication_id' => 3,
            'dosage' => '5 ml',
            'frequency' => 'cada 8 horas',
            'start_date' => '2026-10-18',
            'end_date' => '2026-10-25',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('medication_patient')->insert([
            'patient_id' => 3,
            'medication_id' => 1,
            'dosage' => '250 mg',
            'frequency' => 'cada 6 horas',
            'start_date' => '2026-10-22',
            'end_date' => '2026-10-26',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('medication_patient')->insert([
            'patient_id' => 4,
            'medication_id' => 4,
            'dosage' => '50 mg',
            'frequency' => 'cada 24 horas',
            'start_date' => '2026-09-01',
            'end_date' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
