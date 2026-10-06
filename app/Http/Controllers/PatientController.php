<?php

namespace App\Http\Controllers;

class PatientController extends Controller
{
    public function index()
    {
        $judul = 'Data Pasien';
        $jumlahPasien = 30; 

        $patients = [
                         ['id' => 1, 'nama' => 'Ahmad', 'alamat' => 'Kudus'],
                         [ 'id' => 2, 'nama' => 'Siti', 'alamat' => 'Jepara'],
                        ['id' => 3, 'nama' => 'Rina', 'alamat' => 'Pati'],
                    ];

        
        
        return view ('pasien.index', compact('judul', 'jumlahPasien', 'patients')); 
    }

    public function show($id)
    {
        return 'Menampilkan pasien dengan ID: ' . $id;
    }
}