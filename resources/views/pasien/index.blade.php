@extends('layouts.app')

@section('title', 'Pasien')

@section('content')
    <h1>Data Pasien</h1>
    <p>Jumlah pasien: {{ $jumlahPasien }}</p>

    <div style="overflow-x: auto;">
        <table border="1" cellpadding="10" cellspacing="0"
               style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nomor RM</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($patients as $patient)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $patient->medical_record_number }}</td>
                        <td>{{ $patient->name }}</td>
                        <td>
                            @if ($patient->gender === 'L')
                                Laki-laki
                            @elseif ($patient->gender === 'P')
                                Perempuan
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $patient->birth_date }}</td>
                        <td>{{ $patient->address ?? '-' }}</td>
                        <td>{{ $patient->phone ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Belum ada data pasien.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection