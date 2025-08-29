<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliUtama extends Model
{
    use HasFactory;

    protected $table = 'wali_utama';

    protected $fillable = [
        'niw',
        'nama',
        'jenis_kelamin',
        'ayah',
        'ibu',
        'alamat',
        'no_wa',
        'mulai_aktif',
        'milad',
    ];

    protected static function booted()
    {
        static::creating(function ($wali) {
            if (!$wali->niw) {
                $wali->niw = 'NIW-' . str_pad((self::count() + 1), 5, '0', STR_PAD_LEFT);
            }
        });
    }
}
