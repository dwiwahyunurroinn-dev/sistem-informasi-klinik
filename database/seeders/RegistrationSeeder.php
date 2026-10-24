<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Registration;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegistrationSeeder extends Seeder
{
    public function run(): void
    {
        $patients = Patient::orderBy('id')->limit(3)->get();
        $doctor = Doctor::orderBy('id')->first();

        if ($patients->isEmpty() || $doctor === null) {
            throw new \RuntimeException(
                'Seeder pendaftaran memerlukan minimal satu pasien dan satu dokter.'
            );
        }

        DB::transaction(function () use ($patients, $doctor) {
            foreach ($patients as $patient) {
                Registration::firstOrCreate(
                    [
                        'patient_id' => $patient->id,
                        'doctor_id' => $doctor->id,
                        'registration_date' => '2026-10-24',
                        'complaint' => 'Data latihan: pemeriksaan umum.',
                    ],
                    [
                        'status' => 'waiting',
                    ]
                );
            }
        });
    }
}
