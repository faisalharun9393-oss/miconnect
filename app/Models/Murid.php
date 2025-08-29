<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Murid extends Model
{
    use HasFactory;

    protected $table = 'murid';

    protected $fillable = [
        'nim',
        'nama',
        'jk',
        'desa',
        'kecamatan',
        'kabupaten',
        'wali_id',
        'ayah',
        'ibu',
        'no_hp_wali',
        'angkatan',
        'mulai_aktif',
        'sekolah_ammiyah',
        'kelas_ammiyah',
        'sekolah_diniyah',
        'kelas_diniyah',
        'status',
        'foto',
    ];

    // Relasi ke Wali
    public function wali()
    {
        return $this->belongsTo(Wali::class, 'wali_id');
    }
}
