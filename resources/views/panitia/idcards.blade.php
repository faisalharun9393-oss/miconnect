<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; }
        .card {
            width: 200px;
            height: 280px;
            border: 2px solid #000;
            text-align: center;
            margin: 10px;
            padding: 10px;
            float: left;
        }
        img {
            width: 100px;
            height: 120px;
            object-fit: cover;
            border: 1px solid #000;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">ID Card Panitia</h2>
    <div style="display:flex; flex-wrap:wrap;">
        @foreach ($data as $item)
            <div class="card">
                @if($item->foto)
                    <img src="{{ public_path('storage/' . $item->foto) }}" alt="Foto">
                @else
                    <img src="{{ public_path('default.png') }}" alt="Foto">
                @endif
                <h4>{{ $item->nama }}</h4>
                <p>NIP: {{ $item->nip }}</p>
                <p>Jabatan: {{ $item->jabatan->nama_jabatan ?? '-' }}</p>
                <p>Angkatan: {{ $item->angkatan }}</p>
                <p>Status: {{ $item->status }}</p>
            </div>
        @endforeach
    </div>
</body>
</html>
