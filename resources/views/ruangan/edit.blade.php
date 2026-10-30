<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ubah Data Ruangan</h1>
    @if ($errors->any())
        <ul class="errors">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <p>
            <label for="code_ruangan">Kode Ruangan</label><br>
            <input type="text" id="code_ruangan" name="code_ruangan" value="{{ old('code_ruangan', $ruangan->code_ruangan) }}" maxlength="20" required>
        </p>
        <p>
            <label for="nama">Nama</label><br>
            <input type="text" id="nama" name="nama" value="{{ old('nama', $ruangan->nama) }}" maxlength="100" required>
        </p>
        <p>
            <label for="gedung">Gedung</label><br>
            <input type="text" id="gedung" name="gedung" value="{{ old('gedung', $ruangan->gedung) }}" maxlength="100" required>
        </p>
        <p>
            <label for="kapasitas">Kapasitas</label><br>
            <input type="number" id="kapasitas" name="kapasitas" value="{{ old('kapasitas', $ruangan->kapasitas) }}" min="1" max="9999" required>
        </p>
        <p>
            <label style="font-weight: normal;">
                <input type="checkbox" name="is_leb" value="1" {{ old('is_leb', $ruangan->is_leb) ? 'checked' : '' }}>
                Ruangan Lab
            </label>
        </p>
        <p>
            <button type="submit">Simpan Perubahan</button>
            <a href="{{ route('ruangan.index') }}" class="btn">Batal</a>
        </p>
    </form>
</body>
</html>