<?php

namespace App\Http\Controllers;

use App\Models\MuridUtama;
use App\Models\WaliUtama;
use Illuminate\Http\Request;

class MuridUtamaController extends Controller
{
    /**
     * Tampilkan daftar murid utama.
     */
    public function index()
    {
        $murid = MuridUtama::with('wali')->paginate(10);
        return view('murid-utama.index', compact('murid'));
    }

    /**
     * Form tambah murid.
     */
    public function create()
    {
        $wali = WaliUtama::all();
        return view('murid-utama.create', compact('wali'));
    }

    /**
     * Simpan data murid baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:murid_utamas,nim|max:20',
            'nama' => 'required|string|max:100',
            'jk' => 'required|in:L,P',
            'desa' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'ayah' => 'nullable|string|max:100',
            'ibu' => 'nullable|string|max:100',
            'wali_id' => 'nullable|exists:wali_utamas,id',
            'sekolah_ammiyah' => 'nullable|string|max:100',
            'kelas_ammiyah' => 'nullable|string|max:50',
            'sekolah_diniyah' => 'nullable|string|max:100',
            'kelas_diniyah' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
            'tgl_masuk' => 'nullable|date',
        ]);

        MuridUtama::create($request->all());

        return redirect()->route('murid-utama.index')
            ->with('success', 'Data murid berhasil ditambahkan.');
    }

    /**
     * Detail murid.
     */
    public function show(MuridUtama $murid)
    {
        return view('murid-utama.show', compact('murid'));
    }

    /**
     * Form edit murid.
     */
    public function edit(MuridUtama $murid)
    {
        $wali = WaliUtama::all();
        return view('murid-utama.edit', compact('murid', 'wali'));
    }

    /**
     * Update data murid.
     */
    public function update(Request $request, MuridUtama $murid)
    {
        $request->validate([
            'nim' => 'required|max:20|unique:murid_utamas,nim,' . $murid->id,
            'nama' => 'required|string|max:100',
            'jk' => 'required|in:L,P',
            'desa' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'ayah' => 'nullable|string|max:100',
            'ibu' => 'nullable|string|max:100',
            'wali_id' => 'nullable|exists:wali_utamas,id',
            'sekolah_ammiyah' => 'nullable|string|max:100',
            'kelas_ammiyah' => 'nullable|string|max:50',
            'sekolah_diniyah' => 'nullable|string|max:100',
            'kelas_diniyah' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
            'tgl_masuk' => 'nullable|date',
        ]);

        $murid->update($request->all());

        return redirect()->route('murid-utama.index')
            ->with('success', 'Data murid berhasil diperbarui.');
    }

    /**
     * Hapus murid.
     */
    public function destroy(MuridUtama $murid)
    {
        $murid->delete();

        return redirect()->route('murid-utama.index')
            ->with('success', 'Data murid berhasil dihapus.');
    }
}
