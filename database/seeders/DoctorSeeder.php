<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Poli;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = [
            [
                'doctor_code' => 'DR001',
                'poli_code' => 'POL001',
                'name' => 'dr. Ahmad',
                'specialization' => 'Umum',
                'phone' => '081234560001',
                'is_active' => true,
            ],
            [
                'doctor_code' => 'DR002',
                'poli_code' => 'POL003',
                'name' => 'dr. Siti',
                'specialization' => 'Anak',
                'phone' => '081234560002',
                'is_active' => true,
            ],
            [
                'doctor_code' => 'DR003',
                'poli_code' => 'POL004',
                'name' => 'dr. Budi',
                'specialization' => 'Penyakit Dalam',
                'phone' => null,
                'is_active' => true,
            ],
            [
                'doctor_code' => 'DR004',
                'poli_code' => null,
                'name' => 'dr. Dewi',
                'specialization' => 'Kulit dan Kelamin',
                'phone' => '081234560004',
                'is_active' => false,
            ],
            [
                'doctor_code' => 'DR005',
                'poli_code' => 'POL001',
                'name' => 'dr. Rizki',
                'specialization' => 'Bedah',
                'phone' => '081234560005',
                'is_active' => true,
            ],
            [
                'doctor_code' => 'DR006',
                'poli_code' => 'POL005',
                'name' => 'dr. Rina',
                'specialization' => 'Mata',
                'phone' => null,
                'is_active' => false,
            ],
            [
                'doctor_code' => 'DR007',
                'poli_code' => 'POL001',
                'name' => 'dr. Andi',
                'specialization' => 'THT',
                'phone' => '081234560007',
                'is_active' => true,
            ],
            [
                'doctor_code' => 'DR008',
                'poli_code' => 'POL002',
                'name' => 'drg. Putri',
                'specialization' => 'Gigi',
                'phone' => '081234560008',
                'is_active' => true,
            ],
        ];

        // Data tambahan agar pagination (10 data per halaman) bisa diuji.
        // Kode dimulai dari DR101 supaya tidak bentrok dengan dokter
        // yang ditambahkan manual lewat form (DR009, dst).
        $extra = [
            ['dr. Hadi', 'Umum', 'POL001', true],
            ['dr. Wulan', 'Anak', 'POL003', true],
            ['dr. Agus', 'Penyakit Dalam', 'POL004', false],
            ['drg. Maya', 'Gigi', 'POL002', true],
            ['dr. Fajar', 'Umum', 'POL001', true],
            ['dr. Sari', 'Anak', 'POL003', true],
            ['dr. Yoga', 'Penyakit Dalam', 'POL004', true],
        ];

        foreach ($extra as $i => [$name, $specialization, $poliCode, $active]) {
            $doctors[] = [
                'doctor_code' => sprintf('DR%03d', 101 + $i),
                'name' => $name,
                'specialization' => $specialization,
                'phone' => sprintf('0812345%05d', 60000 + $i),
                'is_active' => $active,
                'poli_code' => $poliCode,
            ];
        }

        $poliIds = Poli::pluck('id', 'code');

        foreach ($doctors as $doctor) {
            $poliCode = $doctor['poli_code'];
            unset($doctor['poli_code']);

            $model = Doctor::updateOrCreate(
                ['doctor_code' => $doctor['doctor_code']],
                $doctor
            );

            // poli_id hanya diisi jika masih kosong, supaya pilihan poli
            // yang sudah diatur lewat form tidak tertimpa.
            $poliId = $poliCode !== null ? ($poliIds[$poliCode] ?? null) : null;

            if ($model->poli_id === null && $poliId !== null) {
                $model->update(['poli_id' => $poliId]);
            }
        }
    }
}