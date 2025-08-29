<?php

namespace App\Exports;

use App\Models\WaliUtama;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class WaliUtamaExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return WaliUtama::select(
            'niw','nama','jk','ayah','ibu','alamat','mulai_aktif','no_wa'
        )->orderBy('nama')->get();
    }

    public function headings(): array
    {
        // Pakai header ini juga untuk template import
        return ['niw','nama','jk','ayah','ibu','alamat','mulai_aktif','no_wa'];
    }
}
