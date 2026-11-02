<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $patients = [
            [
                'medical_record_number' => 'RM0001',
                'name' => 'Ahmad',
                'gender' => 'L',
                'birth_date' => '2000-05-10',
                'address' => 'Kudus',
                'phone' => '081234567890',
            ],
            [
                'medical_record_number' => 'RM0002',
                'name' => 'Siti',
                'gender' => 'P',
                'birth_date' => '2001-08-15',
                'address' => 'Jepara',
                'phone' => '081234567891',
            ],
            [
                'medical_record_number' => 'RM0003',
                'name' => 'Budi',
                'gender' => 'L',
                'birth_date' => '1998-02-20',
                'address' => 'Demak',
                'phone' => null,
            ],
            [
                'medical_record_number' => 'RM0004',
                'name' => 'Dewi',
                'gender' => 'P',
                'birth_date' => '2002-11-05',
                'address' => 'Pati',
                'phone' => '081234567893',
            ],
            [
                'medical_record_number' => 'RM0005',
                'name' => 'Rizki',
                'gender' => 'L',
                'birth_date' => '1999-07-12',
                'address' => null,
                'phone' => null,
            ],
        ];

        // Data tambahan agar pagination (10 data per halaman) bisa diuji.
        // Nomor RM dimulai dari RM1001 supaya tidak bentrok dengan data
        // yang ditambahkan manual lewat form (RM0006, RM0007, dst).
        $extra = [
            ['Andi', 'L'], ['Fitri', 'P'], ['Joko', 'L'], ['Lestari', 'P'],
            ['Eko', 'L'], ['Nina', 'P'], ['Hadi', 'L'], ['Wulan', 'P'],
            ['Agus', 'L'], ['Rani', 'P'], ['Bayu', 'L'], ['Intan', 'P'],
            ['Dimas', 'L'], ['Maya', 'P'], ['Fajar', 'L'], ['Sari', 'P'],
            ['Yoga', 'L'], ['Ayu', 'P'], ['Tono', 'L'], ['Putri', 'P'],
        ];
        $cities = ['Kudus', 'Jepara', 'Demak', 'Pati', 'Semarang'];

        foreach ($extra as $i => [$name, $gender]) {
            $patients[] = [
                'medical_record_number' => sprintf('RM%04d', 1001 + $i),
                'name' => $name,
                'gender' => $gender,
                'birth_date' => sprintf(
                    '%d-%02d-%02d',
                    1985 + ($i % 20),
                    1 + ($i % 12),
                    1 + ($i % 28)
                ),
                'address' => $cities[$i % count($cities)],
                'phone' => sprintf('08123456%04d', 7000 + $i),
            ];
        }

        foreach ($patients as $patient) {
            Patient::updateOrCreate(
                [
                    'medical_record_number' =>
                        $patient['medical_record_number'],
                ],
                $patient
            );
        }
    }
}