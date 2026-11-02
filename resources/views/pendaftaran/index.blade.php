@extends('layouts.app')

@section('title', 'Pendaftaran Pasien')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="status">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <h1 class="h3 mb-0">Data Pendaftaran</h1>

        <a href="{{ route('pendaftaran.create') }}" class="btn btn-primary">
            Tambah Pendaftaran
        </a>
    </div>

    {{-- Form pencarian dan filter menggunakan GET --}}
    <form action="{{ route('pendaftaran.index') }}" method="GET" class="card card-body mb-3">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="search" class="form-label">Nama Pasien</label>
                <input
                    type="search"
                    name="search"
                    id="search"
                    class="form-control"
                    value="{{ $search }}"
                    placeholder="Cari nama pasien..."
                >
            </div>

            <div class="col-md-2">
                <label for="doctor_id" class="form-label">Dokter</label>
                <select name="doctor_id" id="doctor_id" class="form-select">
                    <option value="">Semua Dokter</option>
                    @foreach ($doctors as $doctor)
                        <option
                            value="{{ $doctor->id }}"
                            @selected((string) $doctorId === (string) $doctor->id)
                        >
                            {{ $doctor->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="">Semua Status</option>
                    @foreach ($statuses as $value => $statusOption)
                        <option value="{{ $value }}" @selected($status === $value)>
                            {{ $statusOption['label'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="date" class="form-label">Tanggal</label>
                <input
                    type="date"
                    name="date"
                    id="date"
                    class="form-control"
                    value="{{ $date }}"
                >
            </div>

            <div class="col-md-2">
                <label for="direction" class="form-label">Urutan Tanggal</label>
                <select name="direction" id="direction" class="form-select">
                    <option value="desc" @selected($direction === 'desc')>
                        Terbaru
                    </option>
                    <option value="asc" @selected($direction === 'asc')>
                        Terlama
                    </option>
                </select>
            </div>

            <div class="col-12 d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary">
                    Terapkan Filter
                </button>

                <a href="{{ route('pendaftaran.index') }}" class="btn btn-outline-secondary">
                    Reset
                </a>
            </div>
        </div>
    </form>

    <p class="mb-2">
        Jumlah pendaftaran ditemukan: <strong>{{ $registrations->total() }}</strong>
    </p>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Keluhan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($registrations as $registration)
                    <tr>
                        <td>{{ $registrations->firstItem() + $loop->index }}</td>
                        <td>{{ $registration->registration_date?->format('d-m-Y') ?? '-' }}</td>
                        <td>{{ $registration->patient?->name ?? '-' }}</td>
                        <td>{{ $registration->doctor?->name ?? '-' }}</td>
                        <td>{{ $registration->complaint ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $registration->statusBadge() }}">
                                {{ $registration->statusLabel() }}
                            </span>
                        </td>
                        <td>
                            <a
                                href="{{ route('pendaftaran.edit', $registration->id) }}"
                                class="btn btn-sm btn-warning"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('pendaftaran.destroy', $registration->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Hapus data pendaftaran ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            @if ($isFiltered)
                                Tidak ada data pendaftaran yang sesuai dengan pencarian atau filter.
                            @else
                                Belum ada data pendaftaran.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $registrations->links() }}
    </div>
@endsection
