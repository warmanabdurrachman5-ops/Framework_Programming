<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>

    <!-- Mengambil font modern dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
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
            max-width: 600px;
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
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            color: #334155;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        .form-group input:focus {
            outline: none;
            border-color: #0c4d8b;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(12, 77, 139, 0.1); /* Efek glow biru saat diketik */
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
            flex: 1; /* Agar kedua tombol sejajar dan membagi lebar form */
        }

        .btn-simpan {
            background-color: #0c4d8b;
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

    <div class="card-container">
        
        <h1 class="page-title">Tambah Mahasiswa Baru</h1>

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim" value="{{ old('nim') }}" placeholder="Contoh: 2507810040008" maxlength="20" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Warman Abdurachman" maxlength="100" required>
            </div>

            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="text" id="jurusan" name="jurusan" value="{{ old('jurusan') }}" placeholder="Contoh: Application Software Engineering" maxlength="100" required>
            </div>

            <div class="form-group">
                <label for="angkatan">Angkatan</label>
                <input type="number" id="angkatan" name="angkatan" value="{{ old('angkatan') }}" placeholder="Contoh: 2025" min="1900" max="2200" required>
            </div>

            <div class="form-group">
                <label for="email">Email (Opsional)</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Contoh: mahasiswa@contoh.com" maxlength="100">
            </div>

            <div class="form-group">
                <label for="kelas_id">Kelas</label><br>
                <select name="kelas_id" id="kelas_id">
                    <option value="">--Pilih Kelas--</option>
                    @foreach ($kelas as $k)
                    <option value="{{ $k->id }}"{{ old('kelas_id') ==$k->id ? 'selected' : ''}}>
                        {{ $k->nama_kelas }}
                    </option>
                    @endforeach
                </select>
            </div>
            <p>
                <label for="foto">Foto</label><br>
                <input type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/webp">
                <span class="hint">Maxs. 2 MB (JPG/PNG/WEBP). Foto akan otomatis di compres ke webp maksimal 600px</span>
            </p>

            <div class="button-group">
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-batal">Batal</a>
                <button type="submit" class="btn btn-simpan">Simpan Data</button>
            </div>
        </form>

    </div>

</body>
</html>