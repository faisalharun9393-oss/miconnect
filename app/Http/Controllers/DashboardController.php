<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PanitiaUtama;
use App\Models\WaliUtama;
use App\Models\MuridUtama;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahPanitia = PanitiaUtama::count();
        $jumlahWali    = WaliUtama::count();
        $jumlahMurid   = MuridUtama::count();

        return view('dashboard', [
            'jumlahPanitia' => $jumlahPanitia,
            'jumlahWali'    => $jumlahWali,
            'jumlahMurid'   => $jumlahMurid,
        ]);
    }
}
