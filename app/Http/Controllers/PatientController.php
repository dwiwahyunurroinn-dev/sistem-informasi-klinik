<?php

namespace App\Http\Controllers;

class PatientController extends Controller
{
    public function index()
    {
        $judul = 'Data Pasien';
        $jumlahPasien = 25;

        return view ('pasien.index', compact('judul', 'jumlahPasien'));
    }

    public function show($id)
    {
        return 'Menampilkan pasien dengan ID: ' . $id;
    }
}