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
    <h1>Jadwal Kuliah</h1>
    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif
        @include('partials.nav')

        <div>
        <a href="{{ route('jadwal-kuliah.create') }}" class="btn">+ Tambah Jadwal Kuliah</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kelas</th>
                <th>Mata Kuliah</th>
                <th>Dosen</th>
                <th>Ruangan</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Lampiran</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jadwalkuliah as $jk)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $jk->kelas->nama_kelas }}</td>
                    <td>{{ $jk->mataKuliah->nama_mk }}</td>
                    <td>{{ $jk->dosen->nama }}</td>
                    <td>{{ $jk->ruangan->nama }} ({{ $jk->ruangan->kode_ruangan }})</td>
                    <td>{{ $jk->hari }}</td>
                    <td>{{ substr($jk->jam_mulai, 0, 5) }} - {{ substr($jk->jam_selesai, 0, 5) }}</td>
                    <td>
                        @forelse ($jk->lampiran as $lampiran)
                        <div>
                        <a href="{{ asset('storage/' . $lampiran->path) }}"
                                    target="_blank">
                            {{ $lampiran->nama_asli }}
                                    </a>
                                </div>
                            @empty
                                -
                            @endforelse
                        </td>
                    <td>
                        <a href="{{ route('jadwal-kuliah.edit', $jk->id) }}" class="btn">Ubah</a>
                        <form
                            action="{{ route('jadwal-kuliah.destroy', $jk->id) }}"
                            method="POST"
                            style="display: inline"
                            onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Belum ada jadwal kuliah.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>