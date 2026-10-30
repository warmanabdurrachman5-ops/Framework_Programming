<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Tambah Pengguna</h1>

    @if ($errors->any())
    <ul class="errors">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <form action="{{ route('pengguna.store') }}" method="POST">
        @csrf

        <p>
            <label for="name">Nama</label> <br>
            <input type="text" id="name" name="name" value="{{ old('name') }}" maxlength="100" required>
        </p>

        <p>
            <label for="email">Email</label> <br>
            <input type="email" id="email" name="email" value="{{ old('email') }}" maxlength="100" required>
        </p>

        <p>
            <label for="password">password</label> <br>
            <input type="password" id="password" name="password"  mailength="8" required>
        </p>

        <p>
          <label for="role">Role</label> <br>
          <select name="role" id="role" required>
            <option value="">--Pilih Role--</option>
            @foreach ($roles as $r)
            <option value="{{ $r->name }}"{{ old('role') == $r->name ? 'selected' : '' }}>
                {{ $r->name }}</option>
            @endforeach
          </select>
        </p>
        <button type="submit">Simpan</button>
        <a href="{{ route('pengguna.index') }}" class="btn">Batal</a>
    </form>
</body>
</html>