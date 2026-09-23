<?php

namespace App\Http\Controllers;

class DoctorController extends Controller
{
    public function index()
    {
        return view('dokter.index');
    }
}