<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MuridUtama extends Model
{
    use HasFactory;

    protected $table = 'murid_utama'; // pastikan sesuai nama tabel

    protected $fillable = [
        'nim',
        'nama',
        'jk',
        'desa',
        'kecamatan',
        'kabupaten',
        'ayah',
        'ibu',
        'wali_id',
        'angkatan',
        'tgl_masuk',
        'kelas_ammiyah',
        'kelas_diniyah',
        'status',
    ];

    public function wali()
    {
        return $this->belongsTo(WaliUtama::class, 'wali_id');
    }
}
