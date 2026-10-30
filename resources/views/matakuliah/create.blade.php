<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Matakuliah</title>
  <style>
        /* Pengaturan Dasar */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9; /* Background abu-abu muda */
            color: #333;
            margin: 0;
            padding: 40px 20px;
        }

        /* Container Card putih */
        .card-container {
            max-width: 600px; /* Lebar dibatasi agar form tidak terlalu melar */
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            padding: 30px 40px;
        }

        /* Judul Halaman */
        .page-title {
            color: #0c4d8b; /* Biru LP3I */
            font-weight: 700;
            font-size: 22px;
            margin-top: 0;
            margin-bottom: 25px;
            border-bottom: 2px solid #f0f3f6;
            padding-bottom: 15px;
        }

        /* Notifikasi Error */
        .errors {
            background-color: #fef2f2;
            color: #991b1b;
            padding: 15px;
            border: 1px solid #f87171;
            border-radius: 8px;
            margin-bottom: 25px;
            font-size: 14px;
        }
        .errors ul { margin: 0; padding-left: 20px; }

        /* Desain Form Group & Input */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
            color: #4a5568;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            box-sizing: border-box;
            border: 1px solid #cbd5e1;
            border-radius: 8px; /* Sudut input membulat */
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            color: #334155;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        /* Efek ketika input sedang diketik (diklik) */
        .form-group input:focus {
            outline: none;
            border-color: #0c4d8b;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(12, 77, 139, 0.1); /* Efek glow biru */
        }

        /* Desain Tombol */
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
            border-top: 2px solid #f0f3f6;
            padding-top: 20px;
        }

        .btn {
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 14px;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s ease;
            border: none;
            flex: 1; /* Membuat tombol mengisi lebar yang sama */
        }

        .btn-simpan {
            background-color: #0c4d8b; /* Biru utama */
            color: white;
        }
        .btn-simpan:hover { background-color: #093967; }

        .btn-batal {
            background-color: #ffffff;
            color: #64748b;
            border: 1px solid #cbd5e1;
        }
        .btn-batal:hover {
            background-color: #f1f5f9;
            color: #334155;
        }
    </style>
</head>
<body>

    <h1>Tambah Matakuliah Baru</h1>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mata-kuliah.store') }}" method="POST" enctype="multipart/form-data">
        
        @csrf

        <div class="form-group">
            <label for="kode_mk">Kode Matakuliah</label>
            <input type="text" id="kode_mk" name="kode_mk" value="{{ old('kode_mk') }}" placeholder="Contoh: IF101" maxlength="20" required>
        </div>

        <div class="form-group">
            <label for="nama_mk">Nama Matakuliah</label>
            <input type="text" id="nama_mk" name="nama_mk" value="{{ old('nama_mk') }}" placeholder="Contoh: Pemrograman Web" maxlength="100" required>
        </div>

        <div class="form-group">
            <label for="sks">Jumlah SKS</label>
            <input type="number" id="sks" name="sks" value="{{ old('sks') }}" placeholder="Contoh: 3" required>
        </div>

        <div class="form-group">
            <label for="semester">Semester</label>
            <input type="number" id="semester" name="semester" value="{{ old('semester') }}" placeholder="Contoh: 1" required>
        </div>

        <div>
            <label for="modul">Modul Mata Kuliah PDF min:5MB</label>
            <input type="file" id="modul" name="modul" accept=".pdf,application/pdf">
            @error('modul')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-simpan">Simpan Data</button>
        <a href="{{ route('mata-kuliah.index') }}" class="btn btn-batal">Batal</a>

    </form>

</body>
</html>