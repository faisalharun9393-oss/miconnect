@extends('layouts.app')

@section('content')
<h4 class="mb-3">Tambah Wali</h4>

@if($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
    </ul>
  </div>
@endif

<form class="card" method="post" action="{{ route('wali-utama.store') }}">
  @csrf
  <div class="card-body">
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">Id Wali (NIW) *</label>
        <input type="text" name="niw" value="{{ old('niw') }}" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Nama Lengkap *</label>
        <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Jenis Kelamin *</label>
        <select name="jk" class="form-select" required>
          <option value="L" @selected(old('jk')==='L')>Laki-laki</option>
          <option value="P" @selected(old('jk')==='P')>Perempuan</option>
        </select>
      </div>

      <div class="col-md-4">
        <label class="form-label">Nama Suami</label>
        <input type="text" name="ayah" value="{{ old('ayah') }}" class="form-control">
      </div>
      <div class="col-md-4">
        <label class="form-label">Nama Istri</label>
        <input type="text" name="ibu" value="{{ old('ibu') }}" class="form-control">
      </div>
      <div class="col-md-4">
        <label class="form-label">No. WA</label>
        <input type="text" name="no_wa" value="{{ old('no_wa') }}" class="form-control" placeholder="08xxxx">
      </div>

      <!-- Tgl Masuk → otomatis Milad -->
      <div class="col-md-4">
        <label class="form-label">Tgl Masuk (Tahun)</label>
        <select id="tahun_masuk" name="tahun_masuk" class="form-select">
          @for($y = 1945; $y <= $currentYear; $y++)
            <option value="{{ $y }}" @selected($y==$currentYear)>{{ $y }}</option>
          @endfor
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Mulai Aktif (otomatis)</label>
        <input id="mulai_aktif" name="mulai_aktif" class="form-control" readonly>
      </div>

      <!-- Alamat otomatis ala Panitia Utama -->
      <div class="col-12">
        <label class="form-label">Alamat</label>
        <div class="row g-2">
          <div class="col-md-3">
            <select id="prov" class="form-select">
              <option value="">-- Provinsi --</option>
              @foreach($provinces as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-3">
            <select id="kab" class="form-select" disabled>
              <option value="">-- Kabupaten/Kota --</option>
            </select>
          </div>
          <div class="col-md-3">
            <select id="kec" class="form-select" disabled>
              <option value="">-- Kecamatan --</option>
            </select>
          </div>
          <div class="col-md-3">
            <select id="des" class="form-select" disabled>
              <option value="">-- Desa/Kelurahan --</option>
            </select>
          </div>
          <div class="col-md-12">
            <input id="alamat_detail" class="form-control" placeholder="RT/RW, Dusun, Jalan, No Rumah...">
          </div>
        </div>
        <input type="hidden" id="alamat" name="alamat">
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
    const milad = Math.max(0, year - baseYear); // 2025-1945=80
    mulaiAktif.value = `Milad ke-${milad} / ${year}`;
  }
  tahunSelect.addEventListener('change', updateMilad);
  updateMilad();

  // ===== Alamat otomatis
  function setAlamatHidden(){
    const prov = $('#prov option:selected').text();
    const kab  = $('#kab option:selected').text();
    const kec  = $('#kec option:selected').text();
    const des  = $('#des option:selected').text();
    const det  = $('#alamat_detail').val() || '';
    const arr  = [det, des, kec, kab, prov].filter(Boolean);
    $('#alamat').val(arr.join(', '));
  }
  $('#prov').on('change', function(){
    const id = $(this).val();
    $('#kab').prop('disabled', !id).html('<option value="">-- Kabupaten/Kota --</option>');
    $('#kec').prop('disabled', true).html('<option value="">-- Kecamatan --</option>');
    $('#des').prop('disabled', true).html('<option value="">-- Desa/Kelurahan --</option>');
    if(!id) return setAlamatHidden();
    $.get(`{{ url('ajax/regencies') }}/${id}`, function(res){
      res.forEach(r => $('#kab').append(new Option(r.name, r.id)));
    });
    setAlamatHidden();
  });
  $('#kab').on('change', function(){
    const id = $(this).val();
    $('#kec').prop('disabled', !id).html('<option value="">-- Kecamatan --</option>');
    $('#des').prop('disabled', true).html('<option value="">-- Desa/Kelurahan --</option>');
    if(!id) return setAlamatHidden();
    $.get(`{{ url('ajax/districts') }}/${id}`, function(res){
      res.forEach(r => $('#kec').append(new Option(r.name, r.id)));
    });
    setAlamatHidden();
  });
  $('#kec').on('change', function(){
    const id = $(this).val();
    $('#des').prop('disabled', !id).html('<option value="">-- Desa/Kelurahan --</option>');
    if(!id) return setAlamatHidden();
    $.get(`{{ url('ajax/villages') }}/${id}`, function(res){
      res.forEach(r => $('#des').append(new Option(r.name, r.id)));
    });
    setAlamatHidden();
  });
  $('#des, #alamat_detail').on('change keyup', setAlamatHidden);
</script>
@endpush
