@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah Panitia</h4>

    <form action="{{ route('panitia-utama.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- NIP (Auto Generate) --}}
        <div class="mb-3">
            <label class="form-label">NIP</label>
            <input type="text" name="nip" value="{{ $nip ?? '' }}" class="form-control" readonly>
        </div>

        {{-- Nama --}}
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        {{-- Jenis Kelamin --}}
        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jk" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        {{-- Provinsi --}}
        <div class="mb-3">
            <label class="form-label">Provinsi</label>
            <select id="provinsi" name="provinsi" class="form-control" required>
                <option value="">-- Pilih Provinsi --</option>
                @foreach(\Indonesia::allProvinces() as $provinsi)
                    <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Kabupaten --}}
        <div class="mb-3">
            <label class="form-label">Kabupaten/Kota</label>
            <select id="kabupaten" name="kabupaten" class="form-control" required>
                <option value="">-- Pilih Kabupaten --</option>
            </select>
        </div>

        {{-- Kecamatan --}}
        <div class="mb-3">
            <label class="form-label">Kecamatan</label>
            <select id="kecamatan" name="kecamatan" class="form-control" required>
                <option value="">-- Pilih Kecamatan --</option>
            </select>
        </div>

        {{-- Desa --}}
        <div class="mb-3">
            <label class="form-label">Desa</label>
            <select id="desa" name="desa" class="form-control" required>
                <option value="">-- Pilih Desa --</option>
            </select>
        </div>

        {{-- Dusun --}}
        <div class="mb-3">
            <label class="form-label">Dusun</label>
            <input type="text" name="dusun" class="form-control">
        </div>

        {{-- Jabatan --}}
        <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <select name="jabatan_id" class="form-control" required>
                <option value="">-- Pilih Jabatan --</option>
                @foreach($jabatan as $j)
                    <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                @endforeach
            </select>
        </div>

        {{-- Angkatan --}}
        <div class="mb-3">
            <label class="form-label">Angkatan</label>
            <input type="text" name="angkatan" class="form-control" required>
        </div>

        {{-- Mulai Aktif (Tahun / Milad) --}}
        <div class="mb-3">
            <label class="form-label">Mulai Aktif (Tahun / Milad)</label>
            <select name="mulai_aktif" class="form-control" required>
                <option value="">-- Pilih Tahun / Milad --</option>
                @php
                    $startYear = 1945;
                    $currentYear = date('Y');
                @endphp
                @for ($year = $startYear; $year <= $currentYear; $year++)
                    @php
                        $milad = $year - 1945 + 1;
                    @endphp
                    <option value="{{ $year }}">
                        {{ $year }} / Milad ke-{{ $milad }}
                    </option>
                @endfor
            </select>
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="Aktif">Aktif</option>
                <option value="Nonaktif">Nonaktif</option>
            </select>
        </div>

        {{-- Foto --}}
        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('panitia-utama.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

{{-- AJAX Cascading Dropdown --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#provinsi').on('change', function () {
        let provinsi_id = $(this).val();
        $('#kabupaten').html('<option value="">-- Loading --</option>');
        $.get('/get-kabupaten/' + provinsi_id, function (data) {
            $('#kabupaten').empty().append('<option value="">-- Pilih Kabupaten --</option>');
            data.forEach(function (item) {
                $('#kabupaten').append('<option value="'+item.id+'">'+item.name+'</option>');
            });
        });
    });

    $('#kabupaten').on('change', function () {
        let kabupaten_id = $(this).val();
        $('#kecamatan').html('<option value="">-- Loading --</option>');
        $.get('/get-kecamatan/' + kabupaten_id, function (data) {
            $('#kecamatan').empty().append('<option value="">-- Pilih Kecamatan --</option>');
            data.forEach(function (item) {
                $('#kecamatan').append('<option value="'+item.id+'">'+item.name+'</option>');
            });
        });
    });

    $('#kecamatan').on('change', function () {
        let kecamatan_id = $(this).val();
        $('#desa').html('<option value="">-- Loading --</option>');
        $.get('/get-desa/' + kecamatan_id, function (data) {
            $('#desa').empty().append('<option value="">-- Pilih Desa --</option>');
            data.forEach(function (item) {
                $('#desa').append('<option value="'+item.id+'">'+item.name+'</option>');
            });
        });
    });
</script>
@endsection
