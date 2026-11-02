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
        $patients = Patient::orderBy('id')->get();
        $doctors = Doctor::where('is_active', true)->orderBy('id')->get();

        if ($patients->isEmpty() || $doctors->isEmpty()) {
            throw new \RuntimeException(
                'Seeder pendaftaran memerlukan minimal satu pasien dan satu dokter aktif.'
            );
        }

        $complaints = [
            'Demam dan batuk',
            'Sakit kepala',
            'Nyeri perut',
            'Kontrol rutin',
            'Sakit gigi',
            'Gatal pada kulit',
            'Pilek',
            'Nyeri sendi',
        ];

        $statuses = ['waiting', 'done', 'done', 'cancelled'];

        $dates = [
            '2026-10-20',
            '2026-10-21',
            '2026-10-22',
            '2026-10-23',
            '2026-10-24',
            '2026-10-25',
            '2026-10-26',
            '2026-10-27',
        ];

        DB::transaction(function () use (
            $patients,
            $doctors,
            $complaints,
            $statuses,
            $dates
        ) {
            // Data awal praktikum 06 (tetap dipertahankan).
            foreach ($patients->take(3) as $patient) {
                Registration::firstOrCreate(
                    [
                        'patient_id' => $patient->id,
                        'doctor_id' => $doctors->first()->id,
                        'registration_date' => '2026-10-24',
                        'complaint' => 'Data latihan: pemeriksaan umum.',
                    ],
                    [
                        'status' => 'waiting',
                    ]
                );
            }

            // Data tambahan praktikum 07 agar search, filter, sorting,
            // dan pagination bisa diuji (dokter, status, tanggal bervariasi).
            for ($i = 0; $i < 22; $i++) {
                $patient = $patients[$i % $patients->count()];
                $doctor = $doctors[($i * 3 + 1) % $doctors->count()];

                Registration::firstOrCreate(
                    [
                        'patient_id' => $patient->id,
                        'doctor_id' => $doctor->id,
                        'registration_date' => $dates[$i % count($dates)],
                        'complaint' => $complaints[$i % count($complaints)],
                    ],
                    [
                        'status' => $statuses[$i % count($statuses)],
                    ]
                );
            }
        });
    }
}
