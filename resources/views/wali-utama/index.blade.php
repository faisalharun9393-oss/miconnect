@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4 class="mb-0">Wali Utama</h4>
  <div>
    <a href="{{ route('wali-utama.export') }}" class="btn btn-outline-success btn-sm">Export Excel</a>
    <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">Import Excel</button>
    <a href="{{ route('wali-utama.create') }}" class="btn btn-primary btn-sm">+ Add</a>
  </div>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form class="row g-2 mb-3" method="get">
  <div class="col-auto">
    <input type="text" name="q" value="{{ $q }}" class="form-control form-control-sm" placeholder="Cari nama/NIW...">
  </div>
  <div class="col-auto">
    <button class="btn btn-sm btn-outline-primary">Cari</button>
    <a href="{{ route('wali-utama.index') }}" class="btn btn-sm btn-light">Reset</a>
  </div>
</form>

<div class="card">
  <div class="table-responsive">
    <table class="table table-sm table-hover mb-0">
      <thead class="table-light">
        <tr>
          <th style="width:100px">Aksi</th>
          <th>NIW</th>
          <th>Nama</th>
          <th>J/K</th>
          <th>Ayah</th>
          <th>Ibu</th>
          <th>Alamat</th>
          <th>Mulai Aktif</th>
          <th>No WA</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $row)
          <tr>
            <td class="text-nowrap">
              <a class="btn btn-xs btn-outline-info" href="{{ route('wali-utama.show',$row->id) }}">Detail</a>
              <a class="btn btn-xs btn-outline-warning" href="{{ route('wali-utama.edit',$row->id) }}">Edit</a>
              <form action="{{ route('wali-utama.destroy',$row->id) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-xs btn-outline-danger">Hapus</button>
              </form>
            </td>
            <td>
              <a href="{{ route('wali-utama.show',$row->id) }}" class="text-decoration-none fw-semibold">{{ $row->niw }}</a>
            </td>
            <td>{{ $row->nama }}</td>
            <td>{{ $row->jk }}</td>
            <td>{{ $row->ayah }}</td>
            <td>{{ $row->ibu }}</td>
            <td>{{ $row->alamat }}</td>
            <td>{{ $row->mulai_aktif }}</td>
            <td>{{ $row->no_wa }}</td>
          </tr>
        @empty
          <tr><td colspan="9" class="text-center text-muted">Belum ada data.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($data->hasPages())
    <div class="card-footer py-2">
      {{ $data->links() }}
    </div>
  @endif
</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="post" action="{{ route('wali-utama.import') }}" enctype="multipart/form-data">
      @csrf
      <div class="modal-header"><h5 class="modal-title">Import Excel</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-2 small text-muted">
          Header wajib: <code>niw, nama, jk, ayah, ibu, alamat, mulai_aktif, no_wa</code>
        </div>
        <input type="file" name="file" class="form-control" accept=".xlsx,.xls" required>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Import</button>
      </div>
    </form>
  </div>
</div>
@endsection
