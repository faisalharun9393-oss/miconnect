@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-3">📚 Data Murid Utama</h4>

    {{-- Tombol Aksi Global --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <a href="{{ route('murid-utama.create') }}" class="btn btn-primary">➕ Tambah Murid</a>
            <a href="{{ route('murid-utama.template') }}" class="btn btn-info">📥 Download Template</a>
            <a href="{{ route('murid-utama.export') }}" class="btn btn-success">📤 Export Excel</a>
        </div>
        <div>
            {{-- Form Import --}}
            <form action="{{ route('murid-utama.import') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                @csrf
                <input type="file" name="file" required>
                <button type="submit" class="btn btn-primary">📂 Import Excel</button>
            </form>

            {{-- Search --}}
            <form action="{{ route('murid-utama.index') }}" method="GET" class="d-inline">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="🔍 Cari murid..." class="form-control d-inline" style="width:200px;">
            </form>
        </div>
    </div>

    {{-- Tabel Data --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Aksi</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>J/K</th>
                    <th>Alamat</th>
                    <th>Ayah</th>
                    <th>Ibu</th>
                    <th>Wali</th>
                    <th>Angkatan</th>
                    <th>Mulai Aktif</th>
                    <th>Kelas Ammiyah</th>
                    <th>Kelas Diniyah</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($murid as $m)
                <tr>
                    <td>
                        <a href="{{ route('murid-utama.show', $m->id) }}" class="btn btn-info btn-sm">👁</a>
                        <a href="{{ route('murid-utama.edit', $m->id) }}" class="btn btn-warning btn-sm">✏</a>
                        <form action="{{ route('murid-utama.destroy', $m->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">🗑</button>
                        </form>
                    </td>
                    <td>{{ $m->nim }}</td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->jk }}</td>
                    <td>{{ $m->desa }}, {{ $m->kecamatan }}, {{ $m->kabupaten }}</td>
                    <td>{{ $m->ayah }}</td>
                    <td>{{ $m->ibu }}</td>
                    <td>{{ $m->wali->nama ?? '-' }}</td>
                    <td>{{ $m->angkatan }}</td>
                    <td>{{ $m->tgl_masuk }}</td>
                    <td>{{ $m->kelas_ammiyah }}</td>
                    <td>{{ $m->kelas_diniyah }}</td>
                    <td>{{ $m->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
