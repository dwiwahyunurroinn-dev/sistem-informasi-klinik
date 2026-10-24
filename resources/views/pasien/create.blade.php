@extends('layouts.app')

@section('title', 'Tambah Pasien')

@section('content')
    <h1>Tambah Pasien</h1>

    <form action="{{ route('pasien.store') }}" method="POST">
        @csrf

        @include('pasien._form')

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('pasien.index') }}" class="btn btn-sm btn-outline-secondary">Batal</a>
    </form>
@endsection
