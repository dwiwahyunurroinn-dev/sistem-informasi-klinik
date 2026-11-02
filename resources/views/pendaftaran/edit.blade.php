@extends('layouts.app')

@section('title', 'Edit Pendaftaran')

@section('content')
    <h1>Edit Pendaftaran</h1>

    <form action="{{ route('pendaftaran.update', $pendaftaran->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('pendaftaran._form')

        <button type="submit" class="btn btn-primary">
            Simpan Perubahan
        </button>
        <a href="{{ route('pendaftaran.index') }}" class="btn btn-secondary">
            Batal
        </a>
    </form>
@endsection
