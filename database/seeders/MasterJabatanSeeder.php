<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterJabatanSeeder extends Seeder
{
    public function run(): void
    {
        $jabatan = [
            ['kode_jabatan' => 'JBT-001', 'nama_jabatan' => 'Koordinator'],
            ['kode_jabatan' => 'JBT-002', 'nama_jabatan' => 'Wakil Koodinator'],
            ['kode_jabatan' => 'JBT-003', 'nama_jabatan' => 'Ketua'],
            ['kode_jabatan' => 'JBT-004', 'nama_jabatan' => 'Wakil Ketua'],
            ['kode_jabatan' => 'JBT-005', 'nama_jabatan' => 'Sekretaris'],
            ['kode_jabatan' => 'JBT-006', 'nama_jabatan' => 'Wakil Sekretaris'],
            ['kode_jabatan' => 'JBT-007', 'nama_jabatan' => 'Bendahara'],
            ['kode_jabatan' => 'JBT-008', 'nama_jabatan' => 'Wakil Bendahara'],
            ['kode_jabatan' => 'JBT-009', 'nama_jabatan' => 'Media & Kreatif'],
            ['kode_jabatan' => 'JBT-010', 'nama_jabatan' => 'Koordinator Keacaraan'],
            ['kode_jabatan' => 'JBT-011', 'nama_jabatan' => 'Koordinator Akomodasi'],
            ['kode_jabatan' => 'JBT-012', 'nama_jabatan' => 'Undangan Reguler'],
            ['kode_jabatan' => 'JBT-013', 'nama_jabatan' => 'Undangan VIP'],
            ['kode_jabatan' => 'JBT-014', 'nama_jabatan' => 'Penampilan'],
            ['kode_jabatan' => 'JBT-015', 'nama_jabatan' => 'Pengajian'],
            ['kode_jabatan' => 'JBT-016', 'nama_jabatan' => 'Wisuda'],
            ['kode_jabatan' => 'JBT-017', 'nama_jabatan' => 'Lomba'],
            ['kode_jabatan' => 'JBT-018', 'nama_jabatan' => 'Logistik'],
            ['kode_jabatan' => 'JBT-019', 'nama_jabatan' => 'Keamanan & Parkir'],
            ['kode_jabatan' => 'JBT-020', 'nama_jabatan' => 'Humas'],
            ['kode_jabatan' => 'JBT-021', 'nama_jabatan' => 'Perairan &Kelistrikan'],
            ['kode_jabatan' => 'JBT-022', 'nama_jabatan' => 'Protokoler'],
            ['kode_jabatan' => 'JBT-023', 'nama_jabatan' => 'Lain-Lain'],
        ];

        foreach ($jabatan as $j) {
            DB::table('master_jabatan')->insert([
                'kode_jabatan' => $j['kode_jabatan'],
                'nama_jabatan' => $j['nama_jabatan'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
