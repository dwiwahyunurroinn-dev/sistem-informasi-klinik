@extends('layouts.app')

@section('title', 'Tambah Pendaftaran')

@section('content')
    <h1>Tambah Pendaftaran</h1>

    <form action="{{ route('pendaftaran.store') }}" method="POST">
        @csrf

        @include('pendaftaran._form')

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('pendaftaran.index') }}" class="btn btn-secondary">
            Batal
        </a>
    </form>
@endsection
