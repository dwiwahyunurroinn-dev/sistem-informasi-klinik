<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'medical_record_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('patients', 'medical_record_number'),
            ],
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'birth_date' => 'required|date',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
        ]);

        Patient::create($validated);

        return redirect()
            ->route('pasien.index')
            ->with('success', 'Data pasien berhasil ditambahkan.');
    }

    public function show(Patient $pasien)
    {
        return 'Menampilkan pasien dengan ID: ' . $pasien->id;
    }

    public function edit(Patient $pasien)
    {
        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, Patient $pasien)
    {
        $validated = $request->validate([
            'medical_record_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('patients', 'medical_record_number')
                    ->ignore($pasien->id),
            ],
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'birth_date' => 'required|date',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
        ]);

        $pasien->update($validated);

        return redirect()
            ->route('pasien.index')
            ->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy(Patient $pasien)
    {
        if ($pasien->registrations()->exists()) {
            return redirect()
                ->route('pasien.index')
                ->with('error', 'Pasien tidak dapat dihapus karena memiliki data pendaftaran.');
        }

        try {
            $pasien->delete();
        } catch (\Illuminate\Database\QueryException $exception) {
            if ((string) $exception->getCode() !== '23000') {
                throw $exception;
            }

            return redirect()
                ->route('pasien.index')
                ->with('error', 'Pasien tidak dapat dihapus karena masih digunakan oleh data lain.');
        }

        return redirect()
            ->route('pasien.index')
            ->with('success', 'Data pasien berhasil dihapus.');
    }
}
