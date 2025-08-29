@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📋 Data Panitia Utama</h2>

    {{-- ✅ Tombol atas --}}
<div class="mb-3 d-flex justify-content-between align-items-center">

    {{-- ➕ Tambah Panitia (kiri) --}}
    <a href="{{ route('panitia-utama.create') }}" class="btn btn-sm btn-success">
        ➕ Tambah Panitia
    </a>

    {{-- Grup kanan --}}
    <div class="d-flex gap-2">

        {{-- Export + Cetak --}}
        <div class="card p-2 d-flex flex-row align-items-center">
            <a href="{{ route('panitia.export') }}" class="btn btn-outline-success btn-sm me-2">
                📤 Export Excel
            </a>
            <a href="{{ route('panitia.idcards') }}" class="btn btn-outline-danger btn-sm">
                🪪 Cetak Semua ID Card
            </a>
        </div>

        {{-- Import --}}
        <div class="card p-2 d-flex flex-row align-items-center">
            <form action="{{ route('panitia.import') }}" method="POST" enctype="multipart/form-data" class="d-flex">
                @csrf
                <input type="file" name="file" class="form-control form-control-sm me-2" required>
                <button type="submit" class="btn btn-outline-primary btn-sm">
                    📥 Import Excel
                </button>
            </form>
        </div>

    </div>
</div>

    {{-- ✅ Tabel data --}}
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Aksi</th>
                <th>Foto</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>Jabatan</th>
                <th>Angkatan</th>
                <th>Mulai Aktif</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>
                    <a href="{{ route('panitia-utama.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('panitia-utama.show',$item->id) }}" class="btn btn-info btn-sm">👁️</a>
                    <a href="{{ route('panitia-utama.edit',$item->id) }}" class="btn btn-warning btn-sm">✏️</a>
                    <form action="{{ route('panitia-utama.destroy',$item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                    </form>
                    <a href="{{ route('panitia.idcard', $item->id) }}" class="btn btn-secondary btn-sm">🪪 ID Card</a>
                </td>
                <td>
                    @if($item->foto)
                        <img src="{{ asset('storage/'.$item->foto) }}" width="60" class="rounded">
                    @else
                        -
                    @endif
                </td>
                <td>{{ $item->nip }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jk }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->jabatan->nama_jabatan ?? '-' }}</td>
                <td>{{ $item->angkatan }}</td>
                <td>{{ $item->mulai_aktif }}</td>
                <td>{{ $item->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->links() }}
</div>
@endsection
