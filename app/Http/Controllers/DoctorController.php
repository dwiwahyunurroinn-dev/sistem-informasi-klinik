<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $search = is_string($search) ? trim($search) : '';

        $poliId = $request->query('poli_id');
        $poliId = is_string($poliId) && ctype_digit($poliId)
            ? (int) $poliId
            : null;

        $status = $request->query('status');
        $status = in_array($status, ['1', '0'], true) ? $status : null;

        $allowedSorts = ['name', 'doctor_code'];
        $sort = $request->query('sort');
        $sort = in_array($sort, $allowedSorts, true) ? $sort : 'name';

        $direction = $request->query('direction') === 'desc' ? 'desc' : 'asc';

        $doctors = Doctor::with('poli')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('doctor_code', 'like', "%{$search}%");
                });
            })
            ->when($poliId !== null, function ($query) use ($poliId) {
                $query->where('poli_id', $poliId);
            })
            ->when($status !== null, function ($query) use ($status) {
                $query->where('is_active', $status === '1');
            })
            ->orderBy($sort, $direction)
            ->orderBy('id')
            ->paginate(10)
            ->withQueryString();

        // Semua poli (termasuk nonaktif) agar dokter di poli nonaktif tetap bisa difilter.
        $polis = Poli::orderBy('name')->get(['id', 'name']);

        $isFiltered = $search !== '' || $poliId !== null || $status !== null;

        return view('dokter.index', compact(
            'doctors',
            'polis',
            'search',
            'poliId',
            'status',
            'sort',
            'direction',
            'isFiltered'
        ));
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
