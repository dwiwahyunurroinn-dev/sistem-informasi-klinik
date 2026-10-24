@extends('layouts.app')

@section('title', 'Edit Pasien')

@section('content')
    <h1>Edit Pasien</h1>

    <form action="{{ route('pasien.update', $pasien->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('pasien._form')

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('pasien.index') }}" class="btn btn-sm btn-outline-secondary">Batal</a>
    </form>
@endsection
