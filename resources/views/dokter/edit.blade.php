@extends('layouts.app')

@section('title', 'Edit Dokter')

@section('content')
    <h1>Edit Dokter</h1>

    <form action="{{ route('dokter.update', $dokter->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('dokter._form')

        <button type="submit" class="btn btn-primary">
            Simpan Perubahan
        </button>
        <a href="{{ route('dokter.index') }}" class="btn btn-secondary">
            Batal
        </a>
    </form>
@endsection
