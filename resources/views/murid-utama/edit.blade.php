@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Murid</h3>

    <form action="{{ route('murid-utama.update', $murid->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('murid-utama.form', ['murid' => $murid])
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('murid-utama.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
