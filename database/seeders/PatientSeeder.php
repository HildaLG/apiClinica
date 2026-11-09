<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('patients')->insert([
            'doctor_id' => 1,
            'name' => 'Ana Martínez Peña',
            'email' => 'ana.martinez@mail.com',
            'phone' => '9712000001',
            'birthdate' => '1995-03-10',
            'gender' => 'F',
            'address' => 'Calle Hidalgo 12, Salina Cruz',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('patients')->insert([
            'doctor_id' => 1,
            'name' => 'Luis Hernández Núñez',
            'email' => 'luis.hernandez@mail.com',
            'phone' => '9712000002',
            'birthdate' => '1988-07-22',
            'gender' => 'M',
            'address' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('patients')->insert([
            'doctor_id' => 2,
            'name' => 'Carla Ñáñez Ruiz',
            'email' => 'carla.nanez@mail.com',
            'phone' => '9712000003',
            'birthdate' => '2018-11-05',
            'gender' => 'F',
            'address' => 'Av. Tehuantepec 45, Salina Cruz',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('patients')->insert([
            'doctor_id' => 3,
            'name' => 'Pedro Gómez Luna',
            'email' => 'pedro.gomez@mail.com',
            'phone' => '9712000004',
            'birthdate' => '1975-01-30',
            'gender' => 'O',
            'address' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
