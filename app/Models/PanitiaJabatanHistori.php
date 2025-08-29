<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanitiaJabatanHistori extends Model
{
    use HasFactory;

    protected $table = 'panitia_jabatan_histori';
    protected $fillable = ['panitia_id','jabatan_id','angkatan','tahun'];

    public function panitia() {
        return $this->belongsTo(PanitiaUtama::class);
    }

    public function jabatan() {
        return $this->belongsTo(MasterJabatan::class);
    }
}
