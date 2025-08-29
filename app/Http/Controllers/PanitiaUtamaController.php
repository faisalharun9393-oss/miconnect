<?php

namespace App\Http\Controllers;

use App\Models\PanitiaUtama;
use App\Models\MasterJabatan;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Storage;
use Indonesia;

class PanitiaUtamaController extends Controller
{
    // ✅ LIST DATA
    public function index()
    {
        $data = PanitiaUtama::with('jabatan')->paginate(10);
        return view('panitia.index', compact('data'));
    }

    // ✅ FORM TAMBAH
    public function create()
    {
        $jabatan = MasterJabatan::all();

        // (Opsional) Generate NIP preview di form
        $year = date('Y');
        $lastPanitia = PanitiaUtama::whereYear('created_at', $year)->orderBy('id', 'desc')->first();
        $lastNumber = $lastPanitia ? intval(substr($lastPanitia->nip, 4)) : 0;
        $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
        $nip = $year . $newNumber;

        return view('panitia.create', compact('jabatan', 'nip'));
    }

    // ✅ SIMPAN DATA BARU
    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required',
            'jk'          => 'required',
            'provinsi'    => 'required',
            'kabupaten'   => 'required',
            'kecamatan'   => 'required',
            'desa'        => 'required',
            'dusun'       => 'nullable|string',
            'jabatan_id'  => 'required',
            'angkatan'    => 'required',
            'mulai_aktif' => 'required|date',
            'status'      => 'required',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Generate NIP otomatis
        $year = date('Y');
        $lastPanitia = PanitiaUtama::whereYear('created_at', $year)->orderBy('id', 'desc')->first();
        $lastNumber  = $lastPanitia ? intval(substr($lastPanitia->nip, 4)) : 0;
        $newNumber   = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
        $nip         = $year . $newNumber;

        // Ambil nama wilayah
        $provinsiName  = optional(Indonesia::findProvince($request->provinsi))->name ?? '';
        $kabupatenName = optional(Indonesia::findCity($request->kabupaten))->name ?? '';
        $kecamatanName = optional(Indonesia::findDistrict($request->kecamatan))->name ?? '';
        $desaName      = optional(Indonesia::findVillage($request->desa))->name ?? '';

        $payload = [
            'nip'         => $nip,
            'nama'        => $request->nama,
            'jk'          => $request->jk,
            'alamat'      => trim("$provinsiName, $kabupatenName, $kecamatanName, $desaName, " . ($request->dusun ?? ''), ' ,'),
            'jabatan_id'  => $request->jabatan_id,
            'angkatan'    => $request->angkatan,
            'mulai_aktif' => $request->mulai_aktif,
            'status'      => $request->status,
        ];

        if ($request->hasFile('foto')) {
            $payload['foto'] = $request->file('foto')->store('foto_panitia', 'public');
        }

        PanitiaUtama::create($payload);

        return redirect()->route('panitia-utama.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // ✅ FORM EDIT
    public function edit($id)
    {
        $data    = PanitiaUtama::findOrFail($id);
        $jabatan = MasterJabatan::all();
        return view('panitia.edit', compact('data', 'jabatan'));
    }

    // ✅ DETAIL DATA
    public function show($id)
    {
        $data = PanitiaUtama::with('jabatan')->findOrFail($id);
        return view('panitia.show', compact('data'));
    }

    // ✅ UPDATE DATA
    public function update(Request $request, $id)
    {
        $data = PanitiaUtama::findOrFail($id);

        $request->validate([
            'nip'         => 'required|unique:panitia_utama,nip,' . $id,
            'nama'        => 'required',
            'jk'          => 'required',
            'provinsi'    => 'required',
            'kabupaten'   => 'required',
            'kecamatan'   => 'required',
            'desa'        => 'required',
            'dusun'       => 'nullable|string',
            'jabatan_id'  => 'required',
            'angkatan'    => 'required',
            'mulai_aktif' => 'required|date',
            'status'      => 'required',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $provinsiName  = optional(Indonesia::findProvince($request->provinsi))->name ?? '';
        $kabupatenName = optional(Indonesia::findCity($request->kabupaten))->name ?? '';
        $kecamatanName = optional(Indonesia::findDistrict($request->kecamatan))->name ?? '';
        $desaName      = optional(Indonesia::findVillage($request->desa))->name ?? '';

        $updateData = [
            'nip'         => $request->nip,
            'nama'        => $request->nama,
            'jk'          => $request->jk,
            'alamat'      => trim("$provinsiName, $kabupatenName, $kecamatanName, $desaName, " . ($request->dusun ?? ''), ' ,'),
            'jabatan_id'  => $request->jabatan_id,
            'angkatan'    => $request->angkatan,
            'mulai_aktif' => $request->mulai_aktif,
            'status'      => $request->status,
        ];

        if ($request->hasFile('foto')) {
            if ($data->foto && Storage::disk('public')->exists($data->foto)) {
                Storage::disk('public')->delete($data->foto);
            }
            $updateData['foto'] = $request->file('foto')->store('foto_panitia', 'public');
        }

        $data->update($updateData);

        return redirect()->route('panitia-utama.index')->with('success', 'Data berhasil diupdate!');
    }

    // ✅ HAPUS DATA
    public function destroy($id)
    {
        $data = PanitiaUtama::findOrFail($id);

        if ($data->foto && Storage::disk('public')->exists($data->foto)) {
            Storage::disk('public')->delete($data->foto);
        }

        $data->delete();
        return redirect()->route('panitia-utama.index')->with('success', 'Data berhasil dihapus');
    }

    // ✅ EXPORT EXCEL
    public function exportExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'NIP');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Jenis Kelamin');
        $sheet->setCellValue('D1', 'Alamat');
        $sheet->setCellValue('E1', 'Jabatan');
        $sheet->setCellValue('F1', 'Angkatan');
        $sheet->setCellValue('G1', 'Mulai Aktif');
        $sheet->setCellValue('H1', 'Status');

        $data = PanitiaUtama::with('jabatan')->get();
        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item->nip);
            $sheet->setCellValue('B' . $row, $item->nama);
            $sheet->setCellValue('C' . $row, $item->jk);
            $sheet->setCellValue('D' . $row, $item->alamat);
            $sheet->setCellValue('E' . $row, $item->jabatan->nama_jabatan ?? '-');
            $sheet->setCellValue('F' . $row, $item->angkatan);
            $sheet->setCellValue('G' . $row, $item->mulai_aktif);
            $sheet->setCellValue('H' . $row, $item->status);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'panitia.xlsx';
        $writer->save($filename);

        return response()->download($filename)->deleteFileAfterSend(true);
    }

    // ✅ IMPORT EXCEL
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        foreach ($rows as $key => $row) {
            if ($key == 0) continue;

            PanitiaUtama::updateOrCreate(
                ['nip' => $row[0]],
                [
                    'nama'        => $row[1],
                    'jk'          => $row[2],
                    'alamat'      => $row[3],
                    'jabatan_id'  => $row[4],
                    'angkatan'    => $row[5],
                    'mulai_aktif' => $row[6],
                    'status'      => $row[7],
                ]
            );
        }

        return redirect()->route('panitia-utama.index')->with('success', 'Data berhasil diimport!');
    }

    // ✅ GENERATE ID CARD PDF
    public function generateIdCard($id)
    {
        $data = PanitiaUtama::with('jabatan')->findOrFail($id);

        $pdf = \PDF::loadView('panitia.idcard', compact('data'))
            ->setPaper('A7', 'landscape');

        return $pdf->download('idcard_' . $data->nip . '.pdf');
    }

    public function generateAllIdCards()
    {
        $data = PanitiaUtama::with('jabatan')->get();

        $pdf = \PDF::loadView('panitia.idcards', compact('data'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('idcards_all.pdf');
    }

    // ✅ API WILAYAH
    public function getKabupaten($provinsi_id)
    {
        return response()->json(Indonesia::findProvince($provinsi_id, ['cities'])->cities);
    }

    public function getKecamatan($kabupaten_id)
    {
        return response()->json(Indonesia::findCity($kabupaten_id, ['districts'])->districts);
    }

    public function getDesa($kecamatan_id)
    {
        return response()->json(Indonesia::findDistrict($kecamatan_id, ['villages'])->villages);
    }
}
