<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Poli;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            'jumlahPasien' => Patient::count(),
            'jumlahDokter' => Doctor::count(),
            'jumlahPoli' => Poli::count(),
        ]);
    }
}
