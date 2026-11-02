@extends('layouts.app')

@section('title', 'Data Dokter')

@section('content')
    <h1>Data Dokter</h1>

    @if (session('success'))
        <div class="alert alert-success" role="status">
            {{ session('success') }}
        </div>
    @endif

    <p>
        <a href="{{ route('dokter.create') }}" class="btn btn-primary">
            Tambah Dokter
        </a>
    </p>

    <div class="mb-3">
        <form method="GET" action="{{ route('dokter.index') }}" class="row g-2">
            <div class="col-md-3">
                <input type="text"
                       name="search"
                       value="{{ $search }}"
                       placeholder="Nama / Kode Dokter"
                       class="form-control">
            </div>

            <div class="col-md-2">
                <select name="poli_id" class="form-select">
                    <option value="">Semua Poli</option>
                    @foreach ($polis as $poli)
                        <option value="{{ $poli->id }}" @selected($poliId === $poli->id)>
                            {{ $poli->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="1" @selected($status === '1')>Aktif</option>
                    <option value="0" @selected($status === '0')>Tidak Aktif</option>
                </select>
            </div>

            <div class="col-md-2">
                <select name="sort" class="form-select">
                    <option value="name" @selected($sort === 'name')>Urut: Nama</option>
                    <option value="doctor_code" @selected($sort === 'doctor_code')>Urut: Kode</option>
                </select>
            </div>

            <div class="col-md-1">
                <select name="direction" class="form-select">
                    <option value="asc" @selected($direction === 'asc')>A-Z</option>
                    <option value="desc" @selected($direction === 'desc')>Z-A</option>
                </select>
            </div>

            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Terapkan</button>
                <a href="{{ route('dokter.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>

    @if ($search !== '')
        <p>Hasil pencarian: <strong>{{ $search }}</strong></p>
    @endif

    <p>Menampilkan {{ $doctors->count() }} dari {{ $doctors->total() }} data.</p>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Dokter</th>
                    <th>Nama</th>
                    <th>Spesialisasi</th>
                    <th>Poli</th>
                    <th>Telepon</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($doctors as $doctor)
                    <tr>
                        <td>{{ $doctors->firstItem() + $loop->index }}</td>
                        <td>{{ $doctor->doctor_code }}</td>
                        <td>{{ $doctor->name }}</td>
                        <td>{{ $doctor->specialization }}</td>
                        <td>{{ $doctor->poli?->name ?? '-' }}</td>
                        <td>{{ $doctor->phone ?? '-' }}</td>
                        <td>
                            @if ($doctor->is_active)
                                Aktif
                            @else
                                Tidak Aktif
                            @endif
                        </td>
                        <td>
                            <a
                                href="{{ route('dokter.edit', $doctor->id) }}"
                                class="btn btn-sm btn-primary"
                            >
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">
                            @if ($isFiltered)
                                Tidak ada dokter yang cocok dengan pencarian atau filter.
                                <a href="{{ route('dokter.index') }}">Reset filter</a>
                            @else
                                Belum ada data dokter.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $doctors->links() }}
    </div>
@endsection
