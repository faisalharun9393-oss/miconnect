@extends('layouts.app')

@section('title', 'Tambah Panitia Utama')

@section('content')
<div class="container">
    <h2>Tambah Panitia Utama</h2>

    <form action="{{ route('panitia-utama.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Panitia</label>
            <input type="file" class="form-control" name="foto" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" class="form-control" name="nip" required>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama" required>
        </div>

        <div class="mb-3">
            <label for="jk" class="form-label">Jenis Kelamin</label>
            <select class="form-control" name="jk" required>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="jabatan_id" class="form-label">Jabatan</label>
            <select class="form-control" name="jabatan_id" required>
                @foreach($jabatan as $j)
                    <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="angkatan" class="form-label">Angkatan</label>
            <input type="number" class="form-control" name="angkatan" required>
        </div>

        <div class="mb-3">
            <label for="mulai_aktif" class="form-label">Mulai Aktif (Tahun)</label>
            <input type="number" class="form-control" name="mulai_aktif" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" name="status">
                <option value="Aktif">Aktif</option>
                <option value="Nonaktif">Nonaktif</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="no_telp" class="form-label">No. Telepon</label>
            <input type="text" class="form-control" name="no_telp">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('panitia-utama.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
