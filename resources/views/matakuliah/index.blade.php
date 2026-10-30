<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Matakuliah</title>
  <style>
      @include('partials.style')
    </style>
</head>
<body>

    <h1>Data Matakuliah</h1>

    @include('partials.nav')

    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <div>
        <a href="{{ route('mata-kuliah.create') }}" class="btn">+ Tambah Matakuliah</a>
    </div>

     
    

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Modul</th>
                <th>Kode MK</th>
                <th>Nama Matakuliah</th>
                <th>SKS</th>
                <th>Semester</th>
                <th>Aksi</th>
            </tr>
        </thead>
        
        <tbody>
            @forelse ($matakuliah as $data)
                <tr>
                   
                    <td>{{ $loop->iteration }}</td>
                    <td>
                          @if ($data->modul && \Illuminate\Support\Facades\Storage::disk('public')->exists($data->modul))
                             <a href="{{ asset('storage/' . $data->modul) }}" target="_blank">
                                 Unduh Modul
                             </a>
                             @else
                                 -
                          @endif
                    </td>
                    <td>{{ $data->kode_mk }}</td>
                    <td>{{ $data->nama_mk }}</td>
                    <td>{{ $data->sks }}</td>
                    <td>{{ $data->semester }}</td>
                    
                    
                    <td>
                      
                        <a href="{{ route('mata-kuliah.edit', $data->id) }}" class="btn">Edit</a>

                      
                        <form action="{{ route('mata-kuliah.destroy', $data->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn" >Hapus</button>
                        </form>
                    </td>
                </tr>

            
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Belum ada data matakuliah.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>