<?php

namespace App\Http\Controllers;

class ScheduleController extends Controller
{
    public function index()
    {
        $judul = 'Jadwal Dokter';

        return view('jadwal.index', compact('judul'));
    }

     public function show($hari)
    {
        return 'Jadwal Dokter Hari: ' . $hari;
    }
}