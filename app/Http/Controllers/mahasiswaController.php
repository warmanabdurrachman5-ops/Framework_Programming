<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule; 
use App\Models\kelas;

class mahasiswaController extends Controller
{
    public function __construct(private ImageUploadService $imageUpload)
    {

    }

    public function index(): View
    {
        $mahasiswa = Mahasiswa::with('kelas')
        ->orderBy('id')
        ->paginate('10')
        ->withQueryString(); 
        return view('mahasiswa.index', compact('mahasiswa')); 

    }

    public function create(): View
    {
        $kelas = Kelas::all();
        return view('mahasiswa.create', compact('kelas'));
    }

    
public function store(Request $request): RedirectResponse
{
    $validated = $this->validateMahasiswa($request);

    if ($request->hasFile('foto')) {
        $hasilUpload = $this->imageUpload->store(
            $request->file('foto')
        );

        $validated['foto'] = $hasilUpload['foto'];
        $validated['foto_thumb'] = $hasilUpload['foto_thumb'];
    }

    Mahasiswa::create($validated);

    return redirect()
        ->route('mahasiswa.index')
        ->with('success', 'Data mahasiswa berhasil ditambah');
}

    public function edit(Mahasiswa $mahasiswa): View
{
    $kelas = Kelas::all();

    return view('mahasiswa.edit', compact('mahasiswa','kelas'));
}


public function update(Request $request, Mahasiswa $mahasiswa): RedirectResponse
{
    $validated = $this->validateMahasiswa($request, $mahasiswa);

    if ($request->hasFile('foto')) {
        $fotoLama = $mahasiswa->foto;
        $thumbnailLama = $mahasiswa->foto_thumb;

        $hasilUpload = $this->imageUpload->store(
            $request->file('foto')
        );

        $validated['foto'] = $hasilUpload['foto'];
        $validated['foto_thumb'] = $hasilUpload['foto_thumb'];

        $mahasiswa->update($validated);

        // Hapus foto lama setelah data berhasil diperbarui
        $this->imageUpload->delete($fotoLama);
        $this->imageUpload->delete($thumbnailLama);
    } else {
        $mahasiswa->update($validated);
    }

    return redirect()
        ->route('mahasiswa.index')
        ->with('success', 'Data mahasiswa berhasil diubah.');
}



public function destroy(Mahasiswa $mahasiswa): RedirectResponse
{
    $this->imageUpload->delete($mahasiswa->foto);
    $this->imageUpload->delete($mahasiswa->foto_thumb);

    $mahasiswa->delete();

    return redirect()
        ->route('mahasiswa.index')
        ->with('success', 'Data mahasiswa berhasil dihapus.');
}

private function validateMahasiswa(Request $request, ?Mahasiswa $mahasiswa =null): array
{
      return $request->validate([
            'nim' => [
                'required',
                'string',
                'max:20',
                Rule::unique('mahasiswa', 'nim')->ignore($mahasiswa?->id)
            ],
            'nama' => ['required', 'string', 'max:100'],
            'jurusan' => ['required', 'string', 'max:100'],
            'angkatan' => ['required', 'integer', 'min:1900', 'max:2200'],
            'email' => ['nullable', 'email', 'max:100'],
            'kelas_id' => ['nullable', 'exists:kelas,id'],
            'foto'=> ['nullable','image','mimes:jpeg,jpg,png,webp','max:2048']
        ],
        ['nim.required' => 'nim wajib diisi.',
        'nim.unique' => 'nim sudah di gunakan',
        'nama.required' => 'nama wajib di ini.',
        'jurusan.required' => 'jurusan wajib diisi.',
        'angkatan.required' => 'angkatan wajib diisi.',
        'kelas_id.exists' => 'kelas yang di pilih tidak valid.',
        'foto.image' => 'foto harus berupa gambar.',
        'foto.mimes' => 'foto harus berformat JPG, PNG, atau WebP.',
        'foto.max' => 'Ukuran foto maximal 2 MB.',]
        );
}
} 