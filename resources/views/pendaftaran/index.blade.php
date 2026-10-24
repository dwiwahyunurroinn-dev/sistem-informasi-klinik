@extends('layouts.app')

@section('title', 'Pendaftaran Pasien')

@section('content')
    <p>Jumlah pendaftaran: {{ $registrations->count() }}</p>

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
                </tr>
            </thead>
            <tbody>
                @forelse ($registrations as $registration)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $registration->registration_date?->format('d-m-Y') ?? '-' }}</td>
                        <td>{{ $registration->patient?->name ?? '-' }}</td>
                        <td>{{ $registration->doctor?->name ?? '-' }}</td>
                        <td>{{ $registration->complaint ?? '-' }}</td>
                        <td>{{ $registration->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            Belum ada data pendaftaran.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
