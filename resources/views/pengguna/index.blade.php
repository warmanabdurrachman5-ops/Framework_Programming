<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @include('partials.style')
    </style>
</head>
<body>

    <h1>Data Pengguna</h1>

    @if (session('succes'))
 <p class="success">{{ session('success') }}</p>
    @endif

    @if (session('error'))
    <ul class="errors">
        <li>{{ session('error') }}</li>
    </ul>
    @endif
    @include('partials.nav') 

     <!-- <div class="nav-menu">
         <a href="{{ route('mahasiswa.index') }}" class="active">Data Mahasiswa</a>
            <a href="{{ route('dosen.index') }}">Data Dosen</a>
            <a href="{{ route('mata-kuliah.index') }}">Mata Kuliah</a>
            <a href="{{ route('jadwal-kuliah.index') }}">Jadwal Kuliah</a>
            <a href="{{ route('ruangan.index') }}">Ruangan</a>
            <a href="{{ route('kelas.index') }}">Kelas</a>
            <a href="{{ route('role.index') }}">Role</a>
            <a href="{{ route('pengguna.index') }}">Pengguna</a>
        </div> -->
         @role('admin')
    <p>
    <a href="{{ route('pengguna.create') }}" class="btn">Tambah Pengguna</a>
    </p>
    @endrole
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        @forelse ($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->getRoleNames()->implode(', ') ?:'-'}}</td>
     
      @role('admin')       
      <td>     
    <a href="{{ route('pengguna.edit', $user->id) }}" class="btn">Ubah</a>

    <form 
        action="{{ route('pengguna.destroy', $user->id) }}" 
        method="POST" 
        style="display: inline" 
        onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')"
    >
        @csrf
        @method('DELETE')
        <button type="submit">Hapus</button>
    </form>
@else
    <span>-</span>
@endrole
</td>
</tr>
@empty
<tr>
    <td colspan="5">Belum ada data pengguna.</td>
</tr>
@endforelse
        </tr>
        </tbody>
    </table>
</body>
</html>