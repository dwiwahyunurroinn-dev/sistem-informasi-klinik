@extends('layouts.app')

@section('title', 'Tambah Dokter')

@section('content')
    <h1>Tambah Dokter</h1>

    <form action="{{ route('dokter.store') }}" method="POST">
        @csrf

        @include('dokter._form')

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('dokter.index') }}" class="btn btn-secondary">
            Batal
        </a>
    </form>
@endsection
