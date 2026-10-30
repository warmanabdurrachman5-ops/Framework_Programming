<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal Kuliah</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 40px;
            color: #333;
        }

        /* Container pembungkus utama (Card putih) */
        .card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 30px 40px;
            max-width: 600px; /* Diperkecil untuk form agar proporsional */
            margin: 0 auto;
        }

        h1 {
            color: #00447c;
            margin-top: 0;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 25px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
        }

        /* Pesan Error */
        .errors {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 15px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
            list-style-type: disc;
            padding-left: 40px;
        }
        
        .errors li {
            margin-bottom: 5px;
        }

        /* Gaya Form */
        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: 600;
            font-size: 14px;
            color: #374151;
            display: inline-block;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #1f2937;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            box-sizing: border-box;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #00447c;
            box-shadow: 0 0 0 3px rgba(0, 68, 124, 0.1);
        }

        /* Area Tombol */
        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .btn-primary {
            background-color: #00447c;
            color: #ffffff;
            padding: 10px 24px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #003366;
        }

        .btn-secondary {
            background-color: #ffffff;
            color: #374151;
            border: 1px solid #d1d5db;
            padding: 10px 24px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
        }

        .btn-secondary:hover {
            background-color: #f9fafb;
            color: #1f2937;
        }
    </style>
</head>
<body>
    <h1>Tambah Jadwal Kuliah</h1>
    @if ($errors->any())
        <ul class="errors">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ route('jadwal-kuliah.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <p>
            <label for="kelas_id">Kelas</label><br>
            <select id="kelas_id" name="kelas_id" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelas as $k)
                    <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <label for="matakuliah_id">Mata Kuliah</label><br>
            <select id="matakuliah_id" name="matakuliah_id" required>
                <option value="">-- Pilih Mata Kuliah --</option>
                @foreach ($mataKuliah as $mk)
                    <option value="{{ $mk->id }}" {{ old('matakuliah_id') == $mk->id ? 'selected' : '' }}>
                        {{ $mk->kode_mk }} - {{ $mk->nama_mk }}
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <label for="dosen_id">Dosen</label><br>
            <select id="dosen_id" name="dosen_id" required>
                <option value="">-- Pilih Dosen --</option>
                @foreach ($dosen as $dsn)
                    <option value="{{ $dsn->id }}" {{ old('dosen_id') == $dsn->id ? 'selected' : '' }}>
                        {{ $dsn->nama }}
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <label for="ruangan_id">Ruangan</label><br>
            <select id="ruangan_id" name="ruangan_id" required>
                <option value="">-- Pilih Ruangan --</option>
                @foreach ($ruangan as $r)
                    <option value="{{ $r->id }}" {{ old('ruangan_id') == $r->id ? 'selected' : '' }}>
                        {{ $r->kode_ruangan }} - {{ $r->nama }} (Kapasitas: {{ $r->kapasitas }})
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <label for="hari">Hari</label><br>
            <select id="hari" name="hari" required>
                <option value="">-- Pilih Hari --</option>
                @foreach ($hari as $h)
                    <option value="{{ $h }}" {{ old('hari') == $h ? 'selected' : '' }}>
                        {{ $h }}
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <label for="jam_mulai">Jam Mulai</label><br>
            <input type="time" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}" required>
        </p>
        <p>
            <label for="jam_selesai">Jam Selesai</label><br>
            <input type="time" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') }}" required>
        </p>

        <div class="form-group">
    <label for="lampiran">Lampiran Jadwal (bisa lebih dari satu)</label>

    <input
        type="file"
        id="lampiran"
        name="lampiran[]"
        multiple
    >

    @error('lampiran')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    @error('lampiran.*')
        <p style="color: red;">{{ $message }}</p>
    @enderror
</div>

        <button type="submit">Simpan</button>
        <a href="{{ route('jadwal-kuliah.index') }}" class="btn">Batal</a>
    </form>
</body>
</html>