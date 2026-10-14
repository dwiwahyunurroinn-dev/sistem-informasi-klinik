@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
    <h1>Data Pasien</h1>
    <p>Jumlah pasien: {{ $jumlahPasien }}</p>

    @if (session('success'))
        <p role="status" style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <p>
        <a href="{{ route('pasien.create') }}">Tambah Pasien</a>
    </p>

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
                    <th>Aksi</th>
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
                        <td>
                            <a href="{{ route('pasien.edit', $patient->id) }}">
                                Edit
                            </a>

                            <form action="{{ route('pasien.destroy', $patient->id) }}"
                                  method="POST"
                                  style="display: inline;"
                                  onsubmit="return confirm('Hapus data pasien ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">Belum ada data pasien.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
