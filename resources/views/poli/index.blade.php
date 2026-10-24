@extends('layouts.app')

@section('title', 'Data Poli')

@section('content')
    <h1>Data Poli</h1>
    <p>Jumlah poli: {{ $polis->count() }}</p>

    @if (session('success'))
        <div class="alert alert-success" role="status">
            {{ session('success') }}
        </div>
    @endif

    <p>
        <a href="{{ route('poli.create') }}" class="btn btn-primary">
            Tambah Poli
        </a>
    </p>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
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
                            <div class="d-flex flex-wrap gap-2">
                                <a
                                    href="{{ route('poli.show', $poli->id) }}"
                                    class="btn btn-sm btn-info"
                                >
                                    Detail
                                </a>

                                <a
                                    href="{{ route('poli.edit', $poli->id) }}"
                                    class="btn btn-sm btn-primary"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('poli.destroy', $poli->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Hapus poli ini? Dokter tetap tersimpan, tetapi hubungan ke poli ini akan dikosongkan.')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            Belum ada data poli.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
