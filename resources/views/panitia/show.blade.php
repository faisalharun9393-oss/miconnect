@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-lg rounded-3">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Detail Data Panitia</h4>
        </div>
        <div class="card-body">
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">NIP</div>
                <div class="col-md-9">{{ $data->nip }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Nama</div>
                <div class="col-md-9">{{ $data->nama }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Jenis Kelamin</div>
                <div class="col-md-9">{{ $data->jk }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Alamat Lengkap</div>
                <div class="col-md-9">
                    {{ $data->provinsi }},
                    {{ $data->kabupaten }},
                    {{ $data->kecamatan }},
                    {{ $data->desa }},
                    {{ $data->dusun }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Jabatan</div>
                <div class="col-md-9">{{ $data->jabatan->nama_jabatan ?? '-' }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Angkatan</div>
                <div class="col-md-9">{{ $data->angkatan }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Mulai Aktif</div>
                <div class="col-md-9">{{ $data->mulai_aktif }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Status</div>
                <div class="col-md-9">{{ $data->status }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Foto</div>
                <div class="col-md-9">
                    @if($data->foto)
                        <img src="{{ asset('storage/' . $data->foto) }}" alt="Foto Panitia" width="150" class="rounded shadow">
                    @else
                        <span class="text-muted">Belum ada foto</span>
                    @endif
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('panitia-utama.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('panitia-utama.edit', $data->id) }}" class="btn btn-warning">Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection
