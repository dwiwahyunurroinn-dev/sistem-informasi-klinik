<?php

namespace Database\Seeders;

use App\Models\Poli;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{
    public function run(): void
    {
        $polis = [
            [
                'code' => 'POL001',
                'name' => 'Poli Umum',
                'description' => 'Pelayanan kesehatan umum.',
                'is_active' => true,
            ],
            [
                'code' => 'POL002',
                'name' => 'Poli Gigi',
                'description' => 'Pelayanan kesehatan gigi dan mulut.',
                'is_active' => true,
            ],
            [
                'code' => 'POL003',
                'name' => 'Poli Anak',
                'description' => 'Pelayanan kesehatan anak.',
                'is_active' => true,
            ],
            [
                'code' => 'POL004',
                'name' => 'Poli Penyakit Dalam',
                'description' => 'Pelayanan pemeriksaan penyakit dalam.',
                'is_active' => true,
            ],
            [
                'code' => 'POL005',
                'name' => 'Poli Mata',
                'description' => 'Pelayanan kesehatan mata.',
                'is_active' => false,
            ],
        ];

        foreach ($polis as $poli) {
            Poli::updateOrCreate(
                ['code' => $poli['code']],
                $poli
            );
        }
    }
}
