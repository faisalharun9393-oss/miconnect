@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Murid</h3>

    <form action="{{ route('murid-utama.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('murid-utama.form')
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('murid-utama.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
