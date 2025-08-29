<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi-Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            background: #1f2937;
            color: #fff;
            overflow-y: auto;
        }
        .sidebar a {
            color: #d1d5db;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }
        .sidebar a:hover {
            background: #374151;
            color: #fff;
        }
        .sidebar .submenu {
            padding-left: 25px;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        .sidebar h4 {
            padding: 15px 20px;
            margin: 0;
            font-size: 18px;
            background: #111827;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4>📌 Mi-Connect</h4>

        <a href="{{ url('/home') }}">Dashboard</a>

        <a data-bs-toggle="collapse" href="#dbMenu"><i class="fa fa-database"></i> Database</a>
        <div id="dbMenu" class="collapse submenu">
            <a href="{{ route('panitia-utama.index') }}">Panitia Utama</a>
            <a href="{{ route('wali-utama.index') }}">Wali Utama</a>
            <a href="{{ route('murid-utama.index') }}">Murid Utama</a>
        </div>

        <a data-bs-toggle="collapse" href="#validasiMenu"><i class="fa fa-check-circle"></i> Validasi</a>
        <div id="validasiMenu" class="collapse submenu">
            <a data-bs-toggle="collapse" href="#validasiKepanitiaan">Kepanitiaan</a>
            <div id="validasiKepanitiaan" class="collapse submenu">
                <a href="#">Panitia Inti</a>
                <a href="#">Panitia Bagian</a>
            </div>
            <a data-bs-toggle="collapse" href="#validasiKemuridan">Kemuridan</a>
            <div id="validasiKemuridan" class="collapse submenu">
                <a href="#">Diniyah</a>
                <a href="#">Ammiyah</a>
                <a href="#">Wisuda</a>
            </div>
        </div>

        <a data-bs-toggle="collapse" href="#penilaianMenu"><i class="fa fa-star"></i> Penilaian</a>
        <div id="penilaianMenu" class="collapse submenu">
            <a href="#">Wisuda Terbaik</a>
            <a data-bs-toggle="collapse" href="#lombaMenu">Lomba-Lomba</a>
            <div id="lombaMenu" class="collapse submenu">
                <a href="#">Daftar Lomba</a>
                <a href="#">Peserta Lomba</a>
                <a href="#">Juara</a>
            </div>
        </div>

        <a data-bs-toggle="collapse" href="#programMenu"><i class="fa fa-calendar"></i> Program Kerja</a>
        <div id="programMenu" class="collapse submenu">
            <a href="#">Agenda Kegiatan</a>
            <a href="#">Rundown Acara</a>
        </div>

        <a data-bs-toggle="collapse" href="#keuanganMenu"><i class="fa fa-money-bill"></i> Keuangan</a>
        <div id="keuanganMenu" class="collapse submenu">
            <a data-bs-toggle="collapse" href="#rapbmMenu">RAPBM</a>
            <div id="rapbmMenu" class="collapse submenu">
                <a href="#">Anggaran Pendapatan</a>
                <a href="#">Anggaran Belanja</a>
            </div>
            <a data-bs-toggle="collapse" href="#realisasiMenu">Realisasi</a>
            <div id="realisasiMenu" class="collapse submenu">
                <a href="#">Pendapatan</a>
                <a href="#">Belanja</a>
            </div>
            <a href="#">Rekapitulasi</a>
            <a href="#">Laporan KAS</a>
        </div>

        <a data-bs-toggle="collapse" href="#iuranMenu"><i class="fa fa-coins"></i> Iuran</a>
        <div id="iuranMenu" class="collapse submenu">
            <a href="#">Set Iuran</a>
            <a href="#">Bayar Iuran</a>
        </div>

        <a data-bs-toggle="collapse" href="#dokumenMenu"><i class="fa fa-file-alt"></i> Dokumen</a>
        <div id="dokumenMenu" class="collapse submenu">
            <a href="#">Surat Undangan Wali</a>
            <a href="#">Surat Edaran</a>
            <a href="#">Proposal</a>
            <a href="#">Laporan</a>
        </div>

        <a data-bs-toggle="collapse" href="#profilMenu"><i class="fa fa-user"></i> Profil</a>
        <div id="profilMenu" class="collapse submenu">
            <a href="#">Akun</a>
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-link text-start w-100">
            <i class="fa fa-sign-out-alt"></i> Logout
        </button>
    </form>
</div>

        </div>
    </div>

    <!-- Content -->
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
