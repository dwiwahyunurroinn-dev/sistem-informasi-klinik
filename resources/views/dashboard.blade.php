@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <p>Selamat datang di Sistem Informasi Klinik.</p>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card mb-0 h-100">
                <div class="card-body">
                    <h2 class="h6 text-body-secondary">Jumlah Pasien</h2>
                    <p class="fs-2 fw-semibold">{{ $jumlahPasien }}</p>
                    <a href="{{ route('pasien.index') }}">Lihat Data Pasien</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-0 h-100">
                <div class="card-body">
                    <h2 class="h6 text-body-secondary">Jumlah Dokter</h2>
                    <p class="fs-2 fw-semibold">{{ $jumlahDokter }}</p>
                    <a href="{{ route('dokter.index') }}">Lihat Data Dokter</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-0 h-100">
                <div class="card-body">
                    <h2 class="h6 text-body-secondary">Jumlah Poli</h2>
                    <p class="fs-2 fw-semibold">{{ $jumlahPoli }}</p>
                    <a href="{{ route('poli.index') }}">Lihat Data Poli</a>
                </div>
            </div>
        </div>
    </div>
@endsection
