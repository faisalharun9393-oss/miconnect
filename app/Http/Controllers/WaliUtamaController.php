<?php

namespace App\Http\Controllers;

use App\Models\WaliUtama;
use Illuminate\Http\Request;
use App\Exports\WaliUtamaExport;
use App\Imports\WaliUtamaImport;
use Maatwebsite\Excel\Facades\Excel;

use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Regency;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

class WaliUtamaController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');

        $data = WaliUtama::when($q, fn($w) =>
                $w->where('nama','like',"%$q%")
                  ->orWhere('niw','like',"%$q%")
        )->latest()->paginate(10)->withQueryString();

        return view('wali-utama.index', compact('data','q'));
    }

    public function create()
    {
        $provinces = Province::orderBy('name')->get();
        $currentYear = (int) now()->year;
        $baseYear = 1945; // → Milad ke-(tahun - 1945)

        return view('wali-utama.create', compact('provinces','currentYear','baseYear'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'niw'   => 'required|unique:wali_utama,niw',
            'nama'  => 'required|string',
            'jk'    => 'required|in:L,P',
            'no_wa' => 'nullable|string',
        ]);

        // jika user tak mengirim 'mulai_aktif', hitung dari 'tahun_masuk'
        $mulaiAktif = $request->input('mulai_aktif');
        if (!$mulaiAktif && $request->filled('tahun_masuk')) {
            $year = (int) $request->integer('tahun_masuk');
            $milad = max(0, $year - 1945);
            $mulaiAktif = "Milad ke-{$milad} / {$year}";
        }

        // alamat final sudah dirangkai di JS; fallback kalau belum:
        $alamat = $request->input('alamat');
        if (!$alamat) {
            $alamat = trim($request->input('alamat_detail',''));
        }

        WaliUtama::create([
            'niw'         => $request->niw,
            'nama'        => $request->nama,
            'jk'          => $request->jk,
            'ayah'        => $request->ayah,
            'ibu'         => $request->ibu,
            'alamat'      => $alamat,
            'mulai_aktif' => $mulaiAktif,
            'no_wa'       => $request->no_wa,
        ]);

        return redirect()->route('wali-utama.index')->with('success','Data wali berhasil ditambahkan.');
    }

    public function show(WaliUtama $wali_utama)
    {
        return view('wali-utama.show', ['wali' => $wali_utama]);
    }

    public function edit(WaliUtama $wali_utama)
    {
        $provinces = Province::orderBy('name')->get();
        $currentYear = (int) now()->year;
        $baseYear = 1945;
        $wali = $wali_utama;

        return view('wali-utama.edit', compact('provinces','currentYear','baseYear','wali'));
    }

    public function update(Request $request, WaliUtama $wali_utama)
    {
        $request->validate([
            'niw'   => 'required|unique:wali_utama,niw,'.$wali_utama->id,
            'nama'  => 'required|string',
            'jk'    => 'required|in:L,P',
            'no_wa' => 'nullable|string',
        ]);

        $mulaiAktif = $request->input('mulai_aktif');
        if (!$mulaiAktif && $request->filled('tahun_masuk')) {
            $year = (int) $request->integer('tahun_masuk');
            $milad = max(0, $year - 1945);
            $mulaiAktif = "Milad ke-{$milad} / {$year}";
        }

        $alamat = $request->input('alamat');
        if (!$alamat) {
            $alamat = trim($request->input('alamat_detail',''));
        }

        $wali_utama->update([
            'niw'         => $request->niw,
            'nama'        => $request->nama,
            'jk'          => $request->jk,
            'ayah'        => $request->ayah,
            'ibu'         => $request->ibu,
            'alamat'      => $alamat,
            'mulai_aktif' => $mulaiAktif,
            'no_wa'       => $request->no_wa,
        ]);

        return redirect()->route('wali-utama.index')->with('success','Data wali berhasil diperbarui.');
    }

    public function destroy(WaliUtama $wali_utama)
    {
        $wali_utama->delete();
        return redirect()->route('wali-utama.index')->with('success','Data wali berhasil dihapus.');
    }

    // ===== Excel =====
    public function export()
    {
        return Excel::download(new WaliUtamaExport, 'wali_utama.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls']);
        Excel::import(new WaliUtamaImport, $request->file('file'));
        return redirect()->route('wali-utama.index')->with('success','Import selesai.');
    }

    // ===== AJAX Wilayah (Laravolt) =====
    public function getRegencies($provinceId)
    {
        return response()->json(Regency::where('province_id',$provinceId)->orderBy('name')->get(['id','name']));
    }

    public function getDistricts($regencyId)
    {
        return response()->json(District::where('regency_id',$regencyId)->orderBy('name')->get(['id','name']));
    }

    public function getVillages($districtId)
    {
        return response()->json(Village::where('district_id',$districtId)->orderBy('name')->get(['id','name']));
    }
}
