@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Detail Murid: {{ $murid->nama }}</h3>

    <div class="row">
        <div class="col-md-3">
            @if($murid->foto)
                <img src="{{ asset('storage/'.$murid->foto) }}" class="img-thumbnail">
            @else
                <img src="{{ asset('images/default.png') }}" class="img-thumbnail">
            @endif
        </div>
        <div class="col-md-9">
            <ul class="list-group">
                <li class="list-group-item"><strong>NIM:</strong> {{ $murid->nim }}</li>
                <li class="list-group-item"><strong>Nama:</strong> {{ $murid->nama }}</li>
                <li class="list-group-item"><strong>Jenis Kelamin:</strong> {{ $murid->jk }}</li>
                <li class="list-group-item"><strong>Alamat:</strong> {{ $murid->desa }}, {{ $murid->kecamatan }}, {{ $murid->kabupaten }}</li>
                <li class="list-group-item"><strong>Ayah:</strong> {{ $murid->ayah }}</li>
                <li class="list-group-item"><strong>Ibu:</strong> {{ $murid->ibu }}</li>
                <li class="list-group-item"><strong>Wali:</strong> {{ $murid->wali->nama ?? '-' }}</li>
                <li class="list-group-item"><strong>Sekolah Ammiyah:</strong> {{ $murid->sekolah_ammiyah }} ({{ $murid->kelas_ammiyah }})</li>
                <li class="list-group-item"><strong>Sekolah Diniyah:</strong> {{ $murid->sekolah_diniyah }} ({{ $murid->kelas_diniyah }})</li>
                <li class="list-group-item"><strong>Status:</strong> {{ $murid->status }}</li>
            </ul>
        </div>
    </div>

    <a href="{{ route('murid-utama.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
