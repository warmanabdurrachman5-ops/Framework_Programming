<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dosen</title>

    <!-- Font modern dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
      @include('partials.style')
    </style>
</head>
<body>

    <div class="card-container">
        
        <h1 class="page-title">Sistem Akademik</h1>

        @include('partials.nav')

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <div class="action-bar">
            <a href="{{ route('dosen.create') }}" class="btn btn-tambah">+ Tambah Dosen</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>NIDN</th>
                    <th>Nama</th>
                    <th>Bidang Keahlian</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($dosen as $dsn)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($dsn->foto)
                        <img 
                        src="{{ asset('storage/' . $dsn->foto) }}" 
                        alt="Foto {{ $dsn->nama }}"
                        width="45"
                        height="45"
                        style="object-fit: cover;"
                        >

                        @else
                        -
                        @endif
                    </td>
                        <td><strong>{{ $dsn->nidn }}</strong></td>
                        <td style="color: #0c4d8b; font-weight: 600;">{{ $dsn->nama }}</td>
                        
                        <td><span class="badge badge-blue">{{ $dsn->bidang_keahlian }}</span></td>
                        
                        <td>{{ $dsn->email }}</td>
                        <td>{{ $dsn->no_telepon }}</td>
                        <td>
                            <a href="{{ route('dosen.edit', $dsn->id) }}" class="btn btn-edit">Edit</a>

                            <form action="{{ route('dosen.destroy', $dsn->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data dosen ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-hapus">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px; color: #94a3b8;">
                            <i>Belum ada data dosen.</i>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</body>
</html>