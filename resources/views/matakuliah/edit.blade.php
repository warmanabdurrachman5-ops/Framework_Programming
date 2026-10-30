<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Matakuliah</title>
   <style>
     @include('partials.style')
    </style>
</head>
<body>

    <h1>Edit Data Matakuliah</h1>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- <p>ID: {{ $matakuliah->id ?? 'ID KOSONG' }}</p> -->

    <form action="{{ route('mata-kuliah.update', $matakuliah->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

        <div class="form-group">
            <label for="kode_mk">Kode Matakuliah</label>
            <input type="text" id="kode_mk" name="kode_mk" value="{{ old('kode_mk', $matakuliah->kode_mk) }}" maxlength="20" required>
        </div>

        <div class="form-group">
            <label for="nama_mk">Nama Matakuliah</label>
            <input type="text" id="nama_mk" name="nama_mk" value="{{ old('nama_mk', $matakuliah->nama_mk) }}" maxlength="100" required>
        </div>

        <div class="form-group">
            <label for="sks">Jumlah SKS</label>
            <input type="number" id="sks" name="sks" value="{{ old('sks', $matakuliah->sks) }}" required>
        </div>

        <div class="form-group">
            <label for="semester">Semester</label>
            <input type="number" id="semester" name="semester" value="{{ old('semester', $matakuliah->semester) }}" required>
        </div>

        <div class="form-group">
    <label for="modul">Modul Mata Kuliah (PDF, maksimal 5 MB)</label>

    @if ($matakuliah->modul)
        <p>
            Modul saat ini tersedia.
            <a href="{{ asset('storage/' . $matakuliah->modul) }}" target="_blank">
                Lihat Modul
            </a>
        <label style="font-weight: normal;">
            <input type="checkbox" name="hapus_modul" value="1">
            Hapus modul saat ini
        </label>
        </p>

        <p>Unggah PDF baru jika ingin mengganti modul lama.</p>
    @else
        <p>Belum ada modul yang diunggah.</p>
    @endif

    <input type="file"
           id="modul"
           name="modul"
           accept=".pdf,application/pdf">

    @error('modul')
        <p style="color: red;">{{ $message }}</p>
    @enderror
</div>

        <button type="submit" class="btn btn-simpan">Update Data</button>
        <a href="{{ route('mata-kuliah.index') }}" class="btn btn-batal">Batal</a>

    </form>

</body>
</html>