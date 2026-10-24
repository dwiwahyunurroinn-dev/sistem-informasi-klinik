@extends('layouts.app')

@section('title', 'Data Dokter')

@section('content')
    <h1>Data Dokter</h1>
    <p>Jumlah dokter: {{ $doctors->count() }}</p>

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
                        <td>{{ $loop->iteration }}</td>
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
                            Belum ada data dokter.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
