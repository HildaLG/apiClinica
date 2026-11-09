<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DoctorSeeder::class);
        $this->call(InsuranceSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(MedicationSeeder::class);
        $this->call(MedicationPatientSeeder::class);
        $this->call(AppointmentSeeder::class);
    }
}
