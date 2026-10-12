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