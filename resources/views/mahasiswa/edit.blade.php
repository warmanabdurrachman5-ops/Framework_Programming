<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Mahasiswa</title>

    <!-- Mengambil font modern dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Pengaturan Dasar */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
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
            box-shadow: 0 0 0 3px rgba(12, 77, 139, 0.1);
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
            flex: 1; 
        }

        /* Warna tombol utama (Update) */
        .btn-utama {
            background-color: #0c4d8b;
            color: white;
        }
        .btn-utama:hover { background-color: #093967; }

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
        
        <h1 class="page-title">Ubah Data Mahasiswa</h1>

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST" enctype="multipart/form-data">
            
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" maxlength="20" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" maxlength="100" required>
            </div>

            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="text" id="jurusan" name="jurusan" value="{{ old('jurusan', $mahasiswa->jurusan) }}" maxlength="100" required>
            </div>

            <div class="form-group">
                <label for="angkatan">Angkatan</label>
                <input type="number" id="angkatan" name="angkatan" value="{{ old('angkatan', $mahasiswa->angkatan) }}" min="1900" max="2200" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $mahasiswa->email) }}">
            </div>

            <div class="form-group">
                <label for="kelas_id">Kelas</label><br>
                <select name="kelas_id" id="kelas_id">
                    <option value="">--Pilih Kelas--</option>
                    @foreach ($kelas as $k)
                    <option value="{{ $k->id }}"{{ old('kelas_id', $mahasiswa->kelas_id) ==$k->id ? 'selected' : ''}}>
                        {{ $k->nama_kelas }}
                    </option>
                    @endforeach
                </select>
            </div>

            <p>
                <label for="foto">Foto</label><br>
                @if ($mahasiswa->foto)
                <img src="{{ $mahasiswa->fotoUrl }}" alt="Foto {{ $mahasiswa->nama }}" class="foto-preview">
                @endif
                 <input type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/webp">
                <span class="hint">Kosingkan jika ingin mengganti foto Maxs. 2 MB (JPG/PNG/WEBP).</span>
            </p>

            <div class="button-group">
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-batal">Batal</a>
                <button type="submit" class="btn btn-utama">Simpan Perubahan</button>
            </div>

        </form>

    </div>

</body>
</html>