<?php

namespace App\Http\Controllers;

use App\Models\Registration;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = Registration::with(['patient', 'doctor'])
            ->orderByDesc('registration_date')
            ->orderByDesc('id')
            ->get();

        return view('pendaftaran.index', compact('registrations'));
    }
}
