@extends('layouts.app')

@section('content')
<h4 class="mb-3">Edit Wali</h4>

@if($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
    </ul>
  </div>
@endif

<form class="card" method="post" action="{{ route('wali-utama.update',$wali->id) }}">
  @csrf @method('PUT')
  <div class="card-body">
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">Id Wali (NIW) *</label>
        <input type="text" name="niw" value="{{ old('niw',$wali->niw) }}" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Nama Lengkap *</label>
        <input type="text" name="nama" value="{{ old('nama',$wali->nama) }}" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Jenis Kelamin *</label>
        <select name="jk" class="form-select" required>
          <option value="L" @selected(old('jk',$wali->jk)==='L')>Laki-laki</option>
          <option value="P" @selected(old('jk',$wali->jk)==='P')>Perempuan</option>
        </select>
      </div>

      <div class="col-md-4">
        <label class="form-label">Nama Suami</label>
        <input type="text" name="ayah" value="{{ old('ayah',$wali->ayah) }}" class="form-control">
      </div>
      <div class="col-md-4">
        <label class="form-label">Nama Istri</label>
        <input type="text" name="ibu" value="{{ old('ibu',$wali->ibu) }}" class="form-control">
      </div>
      <div class="col-md-4">
        <label class="form-label">No. WA</label>
        <input type="text" name="no_wa" value="{{ old('no_wa',$wali->no_wa) }}" class="form-control">
      </div>

      <div class="col-md-4">
        <label class="form-label">Tgl Masuk (Tahun)</label>
        @php
          // kalau ada "mulai_aktif" berisi "... / YYYY", coba ambil tahunnya
          $yearFromMulai = (int) (preg_match('/(\d{4})$/', (string)$wali->mulai_aktif, $m) ? $m[1] : $currentYear);
        @endphp
        <select id="tahun_masuk" name="tahun_masuk" class="form-select">
          @for($y = 1945; $y <= $currentYear; $y++)
            <option value="{{ $y }}" @selected($y==old('tahun_masuk',$yearFromMulai))>{{ $y }}</option>
          @endfor
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Mulai Aktif (otomatis)</label>
        <input id="mulai_aktif" name="mulai_aktif" class="form-control" value="{{ old('mulai_aktif',$wali->mulai_aktif) }}" readonly>
      </div>

      <div class="col-12">
        <label class="form-label">Alamat</label>
        <input id="alamat_detail" class="form-control mb-2" placeholder="RT/RW, Dusun, Jalan, No Rumah..." value="">
        <input type="hidden" id="alamat" name="alamat" value="{{ old('alamat',$wali->alamat) }}">
        <div class="small text-muted">Alamat tersimpan saat disimpan. Biarkan saja kalau tidak perlu ganti.</div>
      </div>
    </div>
  </div>
  <div class="card-footer d-flex gap-2">
    <a href="{{ route('wali-utama.index') }}" class="btn btn-light">Batal</a>
    <button class="btn btn-primary">Simpan</button>
  </div>
</form>
@endsection

@push('scripts')
<script>
  const baseYear = {{ $baseYear }};
  const tahunSelect = document.getElementById('tahun_masuk');
  const mulaiAktif = document.getElementById('mulai_aktif');
  function updateMilad() {
    const year = parseInt(tahunSelect.value || {{ $currentYear }});
    const milad = Math.max(0, year - baseYear);
    mulaiAktif.value = `Milad ke-${milad} / ${year}`;
  }
  tahunSelect.addEventListener('change', updateMilad);
  updateMilad();

  // Alamat: cukup gabungkan detail + alamat lama kalau user ngetik
  function setAlamatHidden(){
    const det = $('#alamat_detail').val() || '';
    if(det.trim().length){
      const old = @json($wali->alamat ?? '');
      $('#alamat').val(det + (old ? ', ' + old : ''));
    }
  }
  $('#alamat_detail').on('keyup change', setAlamatHidden);
</script>
@endpush
