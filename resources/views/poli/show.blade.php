@extends('layouts.app')

@section('title', 'Detail Poli')

@section('content')
    <h1>Detail Poli</h1>

    <dl class="row mb-4">
        <dt class="col-sm-3">Kode Poli</dt>
        <dd class="col-sm-9">{{ $poli->code }}</dd>

        <dt class="col-sm-3">Nama Poli</dt>
        <dd class="col-sm-9">{{ $poli->name }}</dd>

        <dt class="col-sm-3">Deskripsi</dt>
        <dd class="col-sm-9">{{ $poli->description ?? '-' }}</dd>

        <dt class="col-sm-3">Status</dt>
        <dd class="col-sm-9">
            @if ($poli->is_active)
                Aktif
            @else
                Tidak Aktif
            @endif
        </dd>
    </dl>

    <h2>Daftar Dokter</h2>
    <p>Jumlah dokter di poli ini: {{ $poli->doctors->count() }}</p>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Dokter</th>
                    <th>Nama</th>
                    <th>Spesialisasi</th>
                    <th>Telepon</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($poli->doctors as $doctor)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $doctor->doctor_code }}</td>
                        <td>{{ $doctor->name }}</td>
                        <td>{{ $doctor->specialization }}</td>
                        <td>{{ $doctor->phone ?? '-' }}</td>
                        <td>
                            @if ($doctor->is_active)
                                Aktif
                            @else
                                Tidak Aktif
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            Belum ada dokter yang terhubung ke poli ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <p class="mt-3">
        <a href="{{ route('poli.index') }}" class="btn btn-secondary">
            Kembali ke Data Poli
        </a>
    </p>
@endsection
