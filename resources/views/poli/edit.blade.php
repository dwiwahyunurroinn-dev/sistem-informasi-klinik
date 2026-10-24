@extends('layouts.app')

@section('title', 'Edit Poli')

@section('content')
    <h1>Edit Poli</h1>

    <form action="{{ route('poli.update', $poli->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('poli._form')

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('poli.index') }}" class="btn btn-sm btn-outline-secondary">Batal</a>
    </form>
@endsection
