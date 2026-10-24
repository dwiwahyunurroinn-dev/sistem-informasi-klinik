<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('poli')
            ->orderBy('doctor_code')
            ->get();

        return view('dokter.index', compact('doctors'));
    }

    public function create()
    {
        $polis = Poli::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('dokter.create', compact('polis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('doctors', 'doctor_code'),
            ],
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'is_active' => 'required|boolean',
            'poli_id' => [
                'required',
                'integer',
                Rule::exists('polis', 'id')->where('is_active', true),
            ],
        ]);

        Doctor::create($validated);

        return redirect()
            ->route('dokter.index')
            ->with('success', 'Data dokter berhasil ditambahkan.');
    }

    public function edit(Doctor $dokter)
    {
        $polis = Poli::where(function ($query) use ($dokter) {
            $query->where('is_active', true);

            if ($dokter->poli_id !== null) {
                $query->orWhere('id', $dokter->poli_id);
            }
        })
            ->orderBy('name')
            ->get();

        return view('dokter.edit', compact('dokter', 'polis'));
    }

    public function update(Request $request, Doctor $dokter)
    {
        $validated = $request->validate([
            'doctor_code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('doctors', 'doctor_code')->ignore($dokter->id),
            ],
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'is_active' => 'required|boolean',
            'poli_id' => [
                'required',
                'integer',
                Rule::exists('polis', 'id')->where(
                    function ($query) use ($dokter) {
                        $query->where(function ($query) use ($dokter) {
                            $query->where('is_active', true);

                            if ($dokter->poli_id !== null) {
                                $query->orWhere('id', $dokter->poli_id);
                            }
                        });
                    }
                ),
            ],
        ]);

        $dokter->update($validated);

        return redirect()
            ->route('dokter.index')
            ->with('success', 'Data dokter berhasil diperbarui.');
    }
}
