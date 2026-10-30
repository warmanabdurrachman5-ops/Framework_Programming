<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Jadwal Kuliah</title>
    <style>
         @include('partials.style') 
    </style>
</head>
<body>
    <h1>Ubah Jadwal Kuliah</h1>
    @if ($errors->any())
        <ul class="errors">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ route('jadwal-kuliah.update', $jadwalkuliah->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <p>
            <label for="kelas_id">Kelas</label><br>
            <select id="kelas_id" name="kelas_id" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelas as $k)
                    <option value="{{ $k->id }}" {{ old('kelas_id', $jadwalkuliah->kelas_id) == $k->id ? 'selected' : '' }}>
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
                    <option value="{{ $mk->id }}" {{ old('matakuliah_id', $jadwalkuliah->matakuliah_id) == $mk->id ? 'selected' : '' }}>
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
                    <option value="{{ $dsn->id }}" {{ old('dosen_id', $jadwalkuliah->dosen_id) == $dsn->id ? 'selected' : '' }}>
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
            <!-- Hapus penutup </option> di akhir baris ini -->
            <option value="{{ $r->id }}" {{ old('ruangan_id', $jadwalkuliah->ruangan_id) == $r->id ? 'selected' : '' }}>
                <!-- Pastikan menggunakan kode_ruangan atau code_ruangan sesuai database -->
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
                    <option value="{{ $h }}" {{ old('hari', $jadwalkuliah->hari) == $h ? 'selected' : '' }}>
                        {{ $h }}
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <label for="jam_mulai">Jam Mulai</label><br>
            <input type="time" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai', substr($jadwalkuliah->jam_mulai, 0, 5)) }}" required>
        </p>
        <p>
            <label for="jam_selesai">Jam Selesai</label><br>
            <input type="time" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai', substr($jadwalkuliah->jam_selesai, 0, 5)) }}" required>
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
        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('jadwal-kuliah.index') }}" class="btn">Batal</a>
    </form>
</body>
</html>