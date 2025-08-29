@extends('layouts.app')

@section('title', 'Edit Panitia Utama')

@section('content')
<div class="container">
    <h2>Edit Panitia Utama</h2>

    <form action="{{ route('panitia-utama.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Panitia</label><br>
            @if($data->foto)
                <img src="{{ asset('storage/foto_panitia/'.$data->foto) }}" alt="Foto" width="100"><br>
            @endif
            <input type="file" class="form-control mt-2" name="foto" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" class="form-control" name="nip" value="{{ $data->nip }}" required>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama" value="{{ $data->nama }}" required>
        </div>

        <div class="mb-3">
            <label for="jk" class="form-label">Jenis Kelamin</label>
            <select class="form-control" name="jk" required>
                <option value="L" {{ $data->jk == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ $data->jk == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" rows="3" required>{{ $data->alamat }}</textarea>
        </div>

        <div class="mb-3">
            <label for="jabatan_id" class="form-label">Jabatan</label>
            <select class="form-control" name="jabatan_id" required>
                @foreach($jabatan as $j)
                    <option value="{{ $j->id }}" {{ $data->jabatan_id == $j->id ? 'selected' : '' }}>
                        {{ $j->nama_jabatan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="angkatan" class="form-label">Angkatan</label>
            <input type="number" class="form-control" name="angkatan" value="{{ $data->angkatan }}" required>
        </div>

        <div class="mb-3">
            <label for="mulai_aktif" class="form-label">Mulai Aktif (Tahun)</label>
            <input type="number" class="form-control" name="mulai_aktif" value="{{ $data->mulai_aktif }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" name="status">
                <option value="Aktif" {{ $data->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Nonaktif" {{ $data->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="no_telp" class="form-label">No. Telepon</label>
            <input type="text" class="form-control" name="no_telp" value="{{ $data->no_telp }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('panitia-utama.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
