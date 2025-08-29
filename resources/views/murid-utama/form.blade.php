@php
    $isEdit = isset($murid);
@endphp

<div class="mb-3">
    <label for="foto" class="form-label">Foto Murid</label>
    <input type="file" name="foto" class="form-control">
    @if($isEdit && $murid->foto)
        <img src="{{ asset('storage/' . $murid->foto) }}" alt="Foto Murid" class="img-thumbnail mt-2" width="120">
    @endif
</div>

<div class="mb-3">
    <label for="nim" class="form-label">ID Murid (NIM)</label>
    <input type="text" name="nim" class="form-control" value="{{ old('nim', $murid->nim ?? '') }}">
</div>

<div class="mb-3">
    <label for="tgl_masuk" class="form-label">Tgl Masuk (Milad ke ...)</label>
    <select name="tgl_masuk" class="form-select">
        @for($tahun = date('Y'); $tahun >= 1946; $tahun--)
            <option value="{{ $tahun }}" {{ old('tgl_masuk', $murid->tgl_masuk ?? '') == $tahun ? 'selected' : '' }}>
                Milad ke-{{ $tahun - 1945 }} / {{ $tahun }}
            </option>
        @endfor
    </select>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="sekolah_ammiyah" class="form-label">Sekolah Ammiyah</label>
        <input type="text" name="sekolah_ammiyah" class="form-control"
               value="{{ old('sekolah_ammiyah', $murid->sekolah_ammiyah ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label for="kelas_ammiyah" class="form-label">Kelas Ammiyah</label>
        <input type="text" name="kelas_ammiyah" class="form-control"
               value="{{ old('kelas_ammiyah', $murid->kelas_ammiyah ?? '') }}">
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="sekolah_diniyah" class="form-label">Sekolah Diniyah</label>
        <input type="text" name="sekolah_diniyah" class="form-control"
               value="{{ old('sekolah_diniyah', $murid->sekolah_diniyah ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label for="kelas_diniyah" class="form-label">Kelas Diniyah</label>
        <input type="text" name="kelas_diniyah" class="form-control"
               value="{{ old('kelas_diniyah', $murid->kelas_diniyah ?? '') }}">
    </div>
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" class="form-select">
        <option value="Aktif" {{ old('status', $murid->status ?? '') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
        <option value="Cuti" {{ old('status', $murid->status ?? '') == 'Cuti' ? 'selected' : '' }}>Cuti</option>
        <option value="Nonaktif" {{ old('status', $murid->status ?? '') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
    </select>
</div>

<div class="mb-3">
    <label for="nama" class="form-label">Nama Lengkap</label>
    <input type="text" name="nama" class="form-control" value="{{ old('nama', $murid->nama ?? '') }}">
</div>

<div class="mb-3">
    <label for="jk" class="form-label">Jenis Kelamin</label>
    <select name="jk" class="form-select">
        <option value="L" {{ old('jk', $murid->jk ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
        <option value="P" {{ old('jk', $murid->jk ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
    </select>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label for="desa" class="form-label">Desa</label>
        <input type="text" name="desa" class="form-control" value="{{ old('desa', $murid->desa ?? '') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label for="kecamatan" class="form-label">Kecamatan</label>
        <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan', $murid->kecamatan ?? '') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label for="kabupaten" class="form-label">Kabupaten</label>
        <input type="text" name="kabupaten" class="form-control" value="{{ old('kabupaten', $murid->kabupaten ?? '') }}">
    </div>
</div>

<div class="mb-3">
    <label for="wali_id" class="form-label">Wali</label>
    <select name="wali_id" class="form-select">
        <option value="">-- Pilih Wali --</option>
        @foreach($wali as $w)
            <option value="{{ $w->id }}" 
                {{ old('wali_id', $murid->wali_id ?? '') == $w->id ? 'selected' : '' }}>
                {{ $w->nama }}
            </option>
        @endforeach
    </select>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="ayah" class="form-label">Ayah</label>
        <input type="text" name="ayah" class="form-control" value="{{ old('ayah', $murid->ayah ?? '') }}" readonly>
    </div>
    <div class="col-md-6 mb-3">
        <label for="ibu" class="form-label">Ibu</label>
        <input type="text" name="ibu" class="form-control" value="{{ old('ibu', $murid->ibu ?? '') }}" readonly>
    </div>
</div>

<div class="mb-3">
    <label for="no_hp_wali" class="form-label">No HP Wali</label>
    <input type="text" name="no_hp_wali" class="form-control" value="{{ old('no_hp_wali', $murid->no_hp_wali ?? '') }}">
</div>
