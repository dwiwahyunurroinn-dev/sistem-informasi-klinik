<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        // Pencarian berdasarkan nama pasien.
        $search = $request->query('search');
        $search = is_string($search) ? trim($search) : '';

        // Filter berdasarkan dokter.
        $doctorId = $request->query('doctor_id');
        $doctorId = is_string($doctorId)
            && ctype_digit($doctorId)
            && (int) $doctorId > 0
                ? (int) $doctorId
                : null;

        // Filter hanya menerima status yang terdaftar.
        $status = $request->query('status');
        $status = is_string($status)
            && array_key_exists($status, Registration::STATUSES)
                ? $status
                : null;

        // Validasi format dan tanggal kalender.
        $date = $request->query('date');

        if (
            !is_string($date)
            || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)
            || !checkdate(
                (int) substr($date, 5, 2),
                (int) substr($date, 8, 2),
                (int) substr($date, 0, 4)
            )
        ) {
            $date = null;
        }

        // Urutan tanggal hanya menerima asc atau desc.
        $direction = $request->query('direction') === 'asc'
            ? 'asc'
            : 'desc';

        $registrations = Registration::query()
            ->with(['patient', 'doctor'])
            ->when($search !== '', function ($query) use ($search) {
                $query->whereHas('patient', function ($patientQuery) use ($search) {
                    $patientQuery->where('name', 'like', "%{$search}%");
                });
            })
            ->when($doctorId !== null, function ($query) use ($doctorId) {
                $query->where('doctor_id', $doctorId);
            })
            ->when($status !== null, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($date !== null, function ($query) use ($date) {
                $query->whereDate('registration_date', $date);
            })
            ->orderBy('registration_date', $direction)
            ->orderBy('id', $direction)
            ->paginate(10)
            ->withQueryString();

        $doctors = Doctor::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        $statuses = Registration::STATUSES;

        $isFiltered = $search !== ''
            || $doctorId !== null
            || $status !== null
            || $date !== null;

        return view('pendaftaran.index', compact(
            'registrations',
            'doctors',
            'statuses',
            'search',
            'doctorId',
            'status',
            'date',
            'direction',
            'isFiltered'
        ));
    }

    public function create()
    {
        return view('pendaftaran.create', $this->formData());
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        Registration::create($validated);

        return redirect()
            ->route('pendaftaran.index')
            ->with('success', 'Data pendaftaran berhasil ditambahkan.');
    }

    public function edit(Registration $pendaftaran)
    {
        return view('pendaftaran.edit', $this->formData($pendaftaran));
    }

    public function update(Request $request, Registration $pendaftaran)
    {
        $validated = $request->validate($this->rules($pendaftaran));

        $pendaftaran->update($validated);

        return redirect()
            ->route('pendaftaran.index')
            ->with('success', 'Data pendaftaran berhasil diperbarui.');
    }

    public function destroy(Registration $pendaftaran)
    {
        $pendaftaran->delete();

        return redirect()
            ->route('pendaftaran.index')
            ->with('success', 'Data pendaftaran berhasil dihapus.');
    }

    /**
     * Aturan validasi untuk tambah dan edit pendaftaran.
     */
    private function rules(?Registration $pendaftaran = null): array
    {
        return [
            'patient_id' => [
                'required',
                'integer',
                Rule::exists('patients', 'id'),
            ],
            'doctor_id' => [
                'required',
                'integer',
                Rule::exists('doctors', 'id')->where(
                    function ($query) use ($pendaftaran) {
                        $query->where(function ($query) use ($pendaftaran) {
                            $query->where('is_active', true);

                            // Saat edit, dokter lama tetap boleh dipilih
                            // walaupun statusnya sudah tidak aktif.
                            if ($pendaftaran !== null) {
                                $query->orWhere('id', $pendaftaran->doctor_id);
                            }
                        });
                    }
                ),
            ],
            'registration_date' => 'required|date',
            'complaint' => 'nullable|string|max:255',
            'status' => [
                'required',
                Rule::in(array_keys(Registration::STATUSES)),
            ],
        ];
    }

    /**
     * Data untuk dropdown pada form tambah dan edit.
     */
    private function formData(?Registration $pendaftaran = null): array
    {
        $patients = Patient::orderBy('name')
            ->get(['id', 'name', 'medical_record_number']);

        $doctors = Doctor::where(function ($query) use ($pendaftaran) {
            $query->where('is_active', true);

            if ($pendaftaran !== null) {
                $query->orWhere('id', $pendaftaran->doctor_id);
            }
        })
            ->orderBy('name')
            ->get(['id', 'name', 'specialization']);

        $statuses = Registration::STATUSES;
        $defaultDate = now('Asia/Jakarta')->toDateString();

        return compact(
            'pendaftaran',
            'patients',
            'doctors',
            'statuses',
            'defaultDate'
        );
    }
}
