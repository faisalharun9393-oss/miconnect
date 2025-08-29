<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            border: 2px solid #000;
            padding: 10px;
        }
        img {
            width: 80px;
            height: 100px;
            object-fit: cover;
            border: 1px solid #000;
        }
    </style>
</head>
<body>
    <h3>ID Card Panitia</h3>
    <img src="{{ public_path('storage/' . $data->foto) }}" alt="Foto Panitia"><br><br>
    <strong>{{ $data->nama }}</strong><br>
    NIP: {{ $data->nip }} <br>
    Jabatan: {{ $data->jabatan->nama_jabatan ?? '-' }} <br>
    Angkatan: {{ $data->angkatan }} <br>
    Status: {{ $data->status }}
</body>
</html>
