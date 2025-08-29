@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Detail Wali</h4>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    @if($wali->foto)
                        <img src="{{ asset('storage/'.$wali->foto) }}" alt="Foto" class="img-fluid rounded mb-3" style="max-height:220px">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center rounded mb-3" style="height:220px">
                            <span class="text-muted">No Photo</span>
                        </div>
                    @endif
                    <h5 class="mb-1">{{ $wali->nama }}</h5>
                    <div class="text-muted">{{ $wali->niw }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-8">

            <div class="card mb-3">
                <div class="card-header">Identitas</div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted">Nama</div>
                        <div class="col-md-8">{{ $wali->nama }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted">Jenis Kelamin</div>
                        <div class="col-md-8">{{ $wali->jk }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted">Suami (Ayah)</div>
                        <div class="col-md-8">{{ $wali->ayah }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted">Istri (Ibu)</div>
                        <div class="col-md-8">{{ $wali->ibu }}</div>
                    </div>
                    @php
                        $prov = optional(\Indonesia::findProvince($wali->provinsi))->name ?? '';
                        $kab  = optional(\Indonesia::findCity($wali->kabupaten))->name ?? '';
                        $kec  = optional(\Indonesia::findDistrict($wali->kecamatan))->name ?? '';
                        $des  = optional(\Indonesia::findVillage($wali->desa))->name ?? '';
                        $alamatFull = trim(implode(', ', array_filter([$des,$kec,$kab,$prov])) , ' ,');
                        $tahun = (int)$wali->mulai_aktif;
                        $milad = $tahun < 1946 ? 0 : ($tahun - 1946 + 1);
                    @endphp
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted">Alamat</div>
                        <div class="col-md-8">{{ $alamatFull }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted">Mulai Aktif</div>
                        <div class="col-md-8">{{ $wali->mulai_aktif }} / Milad Ke-{{ $milad }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted">No WA</div>
                        <div class="col-md-8">{{ $wali->no_wa }}</div>
                    </div>
                </div>
            </div>

            <a href="{{ route('wali-utama.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('wali-utama.edit', $wali->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection
