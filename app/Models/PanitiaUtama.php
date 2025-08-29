<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanitiaUtama extends Model
{
    use HasFactory;

    protected $table = 'panitia_utama';
    protected $fillable = [
        'nip','nama','jk','alamat','jabatan_id',
        'angkatan','mulai_aktif','tgl_masuk','status','no_telp','foto'
    ];

    public function jabatan() {
        return $this->belongsTo(MasterJabatan::class, 'jabatan_id');
    }

    public function riwayat() {
        return $this->hasMany(PanitiaJabatanHistori::class, 'panitia_id');
    }
}
