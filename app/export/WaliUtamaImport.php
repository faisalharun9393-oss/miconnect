<?php

namespace App\Imports;

use App\Models\WaliUtama;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;

class WaliUtamaImport implements ToModel, WithHeadingRow, SkipsEmptyRows, WithValidation
{
    public function model(array $row)
    {
        // mapping header: niw,nama,jk,ayah,ibu,alamat,mulai_aktif,no_wa
        return new WaliUtama([
            'niw'         => (string)($row['niw'] ?? ''),
            'nama'        => (string)($row['nama'] ?? ''),
            'jk'          => strtoupper((string)($row['jk'] ?? 'L')) === 'P' ? 'P' : 'L',
            'ayah'        => $row['ayah'] ?? null,
            'ibu'         => $row['ibu'] ?? null,
            'alamat'      => $row['alamat'] ?? null,
            'mulai_aktif' => $row['mulai_aktif'] ?? null,
            'no_wa'       => $row['no_wa'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.niw'  => ['required', 'string', Rule::unique('wali_utama','niw')],
            '*.nama' => ['required','string'],
            '*.jk'   => ['nullable', Rule::in(['L','P','l','p'])],
        ];
    }
}
