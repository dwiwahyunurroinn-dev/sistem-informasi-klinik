<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $judul = 'Data Pasien';

        $search = $request->query('search');
        $search = is_string($search) ? trim($search) : '';

        $gender = $request->query('gender');
        $gender = in_array($gender, ['L', 'P'], true) ? $gender : null;

        $allowedSorts = ['name', 'medical_record_number', 'created_at'];
        $sort = $request->query('sort');
        $sort = in_array($sort, $allowedSorts, true) ? $sort : 'name';

        $direction = $request->query('direction') === 'desc' ? 'desc' : 'asc';

        $patients = Patient::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('medical_record_number', 'like', "%{$search}%");
                });
            })
            ->when($gender !== null, function ($query) use ($gender) {
                $query->where('gender', $gender);
            })
            ->orderBy($sort, $direction)
            ->orderBy('id')
            ->paginate(10)
            ->withQueryString();

        $isFiltered = $search !== '' || $gender !== null;

        return view('pasien.index', compact(
            'judul',
            'patients',
            'search',
            'gender',
            'sort',
            'direction',
            'isFiltered'
        ));
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
