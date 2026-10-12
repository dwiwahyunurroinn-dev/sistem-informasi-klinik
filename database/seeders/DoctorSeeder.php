<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = [
            [
                'doctor_code' => 'DR001',
                'name' => 'dr. Ahmad',
                'specialization' => 'Umum',
                'phone' => '081234560001',
                'is_active' => true,
            ],
            [
                'doctor_code' => 'DR002',
                'name' => 'dr. Siti',
                'specialization' => 'Anak',
                'phone' => '081234560002',
                'is_active' => true,
            ],
            [
                'doctor_code' => 'DR003',
                'name' => 'dr. Budi',
                'specialization' => 'Penyakit Dalam',
                'phone' => null,
                'is_active' => true,
            ],
            [
                'doctor_code' => 'DR004',
                'name' => 'dr. Dewi',
                'specialization' => 'Kulit dan Kelamin',
                'phone' => '081234560004',
                'is_active' => false,
            ],
            [
                'doctor_code' => 'DR005',
                'name' => 'dr. Rizki',
                'specialization' => 'Bedah',
                'phone' => '081234560005',
                'is_active' => true,
            ],
            [
                'doctor_code' => 'DR006',
                'name' => 'dr. Rina',
                'specialization' => 'Mata',
                'phone' => null,
                'is_active' => false,
            ],
            [
                'doctor_code' => 'DR007',
                'name' => 'dr. Andi',
                'specialization' => 'THT',
                'phone' => '081234560007',
                'is_active' => true,
            ],
            [
                'doctor_code' => 'DR008',
                'name' => 'drg. Putri',
                'specialization' => 'Gigi',
                'phone' => '081234560008',
                'is_active' => true,
            ],
        ];

        foreach ($doctors as $doctor) {
            Doctor::updateOrCreate(
                ['doctor_code' => $doctor['doctor_code']],
                $doctor
            );
        }
    }
}