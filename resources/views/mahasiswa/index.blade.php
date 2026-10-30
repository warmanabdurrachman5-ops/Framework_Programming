<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    
    <!-- Font modern dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
       @include('partials.style')
       body {
        max-width: 1800px;
       }
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
            @role('admin')
            <a href="{{ route('mahasiswa.create') }}" class="btn btn-tambah">+ Tambah Mahasiswa</a>
           @endrole

             <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <!-- <button type="submit" class="btn">
            Logout
        </button> -->
    </form>
        
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Angkatan</th>
                    <th>Email</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                  
                </tr>
            </thead>
            <tbody>
    @forelse ($mahasiswa as $mhs)
        <tr>
            <td>{{ $mahasiswa->firstItem()+ $loop->index }}</td>
            <!-- <td>
                @if ($mhs->foto)
                <img src="{{ $mhs->fotoUrl }}" alt="Foto {{ $mhs->nama }}" class="foto-thumb">
                @else
                -
                @endif
            </td> -->
            <td>
    @if ($mhs->foto)
        <img
            src="{{ asset('storage/' . $mhs->foto) }}"
            alt="Foto {{ $mhs->nama }}"
            class="foto-thumb"
            width="60"
            height="60"
            style="object-fit: cover;"
        >
    @else
        -
    @endif
</td>

            <td>
                <strong>{{ $mhs->nim }}</strong>
            </td>

            <td style="color: #0c4d8b; font-weight: 600;">
                {{ $mhs->nama }}
            </td>

            <td>
                <span class="badge badge-blue">
                    {{ $mhs->jurusan }}
                </span>
            </td>

            <td>
                <span class="badge">
                    {{ $mhs->angkatan }}
                </span>
            </td>

            <td>
                {{ $mhs->email }}
            </td>

            <td>
                {{ $mhs->kelas->nama_kelas ?? '-' }}
            </td>

            <td>
                {{-- Hanya untuk admin --}}
                @role('admin')

                    <a href="{{ route('mahasiswa.edit', $mhs->id) }}"
                       class="btn btn-edit">
                        Edit
                    </a>

                    <form action="{{ route('mahasiswa.destroy', $mhs->id) }}"
                          method="POST"
                          style="display:inline;"
                          onsubmit="return confirm('Yakin ingin menghapus data mahasiswa ini?');">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-hapus">
                            Hapus
                        </button>
                    </form>

                @else

                    <span>-</span>

                @endrole
            </td>
        </tr>

    @empty

        <tr>
            <td colspan="8"
                style="text-align: center; padding: 40px; color: #94a3b8;">
                <i>Belum ada data mahasiswa.</i>
            </td>
        </tr>

    @endforelse
</tbody>
        </table>

        {{ $mahasiswa->links('pagination.custom') }}
    </div>

</body>
</html>