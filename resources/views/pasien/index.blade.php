@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
    <h1>{{ $judul }}</h1>

    @if (session('success'))
        <p role="status" style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <p>
        <a href="{{ route('pasien.create') }}" class="btn btn-sm btn-outline-secondary">Tambah Pasien</a>
    </p>

    <div class="mb-3">
        <form method="GET" action="{{ route('pasien.index') }}" class="row g-2">
            <div class="col-md-3">
                <input type="text"
                       name="search"
                       value="{{ $search }}"
                       placeholder="Nama / No. RM"
                       class="form-control">
            </div>

            <div class="col-md-2">
                <select name="gender" class="form-select">
                    <option value="">Semua Gender</option>
                    <option value="L" @selected($gender === 'L')>Laki-laki</option>
                    <option value="P" @selected($gender === 'P')>Perempuan</option>
                </select>
            </div>

            <div class="col-md-2">
                <select name="sort" class="form-select">
                    <option value="name" @selected($sort === 'name')>Urut: Nama</option>
                    <option value="medical_record_number" @selected($sort === 'medical_record_number')>Urut: Nomor RM</option>
                    <option value="created_at" @selected($sort === 'created_at')>Urut: Tanggal Input</option>
                </select>
            </div>

            <div class="col-md-2">
                <select name="direction" class="form-select">
                    <option value="asc" @selected($direction === 'asc')>A-Z / Terlama</option>
                    <option value="desc" @selected($direction === 'desc')>Z-A / Terbaru</option>
                </select>
            </div>

            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Terapkan</button>
                <a href="{{ route('pasien.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>

    @if ($search !== '')
        <p>Hasil pencarian: <strong>{{ $search }}</strong></p>
    @endif

    <p>Menampilkan {{ $patients->count() }} dari {{ $patients->total() }} data.</p>

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
                        <td>{{ $patients->firstItem() + $loop->index }}</td>
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
                            <a href="{{ route('pasien.edit', $patient->id) }}" class="btn btn-sm btn-outline-secondary">
                                Edit
                            </a>

                            <form action="{{ route('pasien.destroy', $patient->id) }}"
                                  method="POST"
                                  style="display: inline;"
                                  onsubmit="return confirm('Hapus data pasien ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-primary">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">
                            @if ($isFiltered)
                                Tidak ada pasien yang cocok dengan pencarian atau filter.
                                <a href="{{ route('pasien.index') }}">Reset filter</a>
                            @else
                                Belum ada data pasien.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $patients->links() }}
    </div>
@endsection
