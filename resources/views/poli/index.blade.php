@extends('layouts.app')

@section('title', 'Data Poli')

@section('content')
    <h1>Data Poli</h1>
    <p>Jumlah poli: {{ $polis->count() }}</p>

    @if (session('success'))
        <p role="status" style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <p>
        <a href="{{ route('poli.create') }}">Tambah Poli</a>
    </p>

    <div style="overflow-x: auto;">
        <table border="1" cellpadding="10" cellspacing="0"
               style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Poli</th>
                    <th>Nama Poli</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($polis as $poli)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $poli->code }}</td>
                        <td>{{ $poli->name }}</td>
                        <td>{{ $poli->description ?? '-' }}</td>
                        <td>
                            @if ($poli->is_active)
                                Aktif
                            @else
                                Tidak Aktif
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('poli.edit', $poli->id) }}">
                                Edit
                            </a>

                            <form action="{{ route('poli.destroy', $poli->id) }}"
                                  method="POST"
                                  style="display: inline;"
                                  onsubmit="return confirm('Hapus data poli ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Belum ada data poli.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
