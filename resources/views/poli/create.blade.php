@extends('layouts.app')

@section('title', 'Tambah Poli')

@section('content')
    <h1>Tambah Poli</h1>

    <form action="{{ route('poli.store') }}" method="POST">
        @csrf

        @include('poli._form')

        <button type="submit">Simpan</button>
        <a href="{{ route('poli.index') }}">Batal</a>
    </form>
@endsection
