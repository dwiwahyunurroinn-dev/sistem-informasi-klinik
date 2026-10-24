@extends('layouts.app')

@section('title', $judul)

@section('content')
    <p>Pilih hari untuk melihat respons jadwal dokter.</p>

    <div class="d-flex flex-wrap gap-2">
        @foreach (['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'] as $hari)
            <a
                href="{{ route('jadwal.show', ['hari' => $hari]) }}"
                class="btn btn-outline-secondary"
            >
                {{ ucfirst($hari) }}
            </a>
        @endforeach
    </div>
@endsection
