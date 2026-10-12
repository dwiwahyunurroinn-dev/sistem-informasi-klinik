<?php

namespace App\Http\Controllers;

use App\Models\Patient;

class PatientController extends Controller
{
    public function index()
    {
        $judul = 'Data Pasien';
        $patients = Patient::all();
        $jumlahPasien = $patients->count();

        return view(
            'pasien.index',
            compact('judul', 'jumlahPasien', 'patients')
        );
    }

    public function show($id)
    {
        return 'Menampilkan pasien dengan ID: ' . $id;
    }
}