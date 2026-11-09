<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('appointments')->insert([
            'patient_id' => 1,
            'appointment_date' => '2026-10-20 09:00:00',
            'reason' => 'Dolor de cabeza persistente',
            'status' => 'completed',
            'notes' => 'Se receta paracetamol e ibuprofeno.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('appointments')->insert([
            'patient_id' => 1,
            'appointment_date' => '2026-10-30 10:30:00',
            'reason' => 'Revisión de seguimiento',
            'status' => 'pending',
            'notes' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('appointments')->insert([
            'patient_id' => 3,
            'appointment_date' => '2026-10-22 16:00:00',
            'reason' => 'Fiebre y malestar general',
            'status' => 'completed',
            'notes' => 'Reposo e hidratación.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('appointments')->insert([
            'patient_id' => 4,
            'appointment_date' => '2026-10-28 12:00:00',
            'reason' => 'Control de presión arterial',
            'status' => 'cancelled',
            'notes' => 'El paciente avisó que no podía asistir.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
