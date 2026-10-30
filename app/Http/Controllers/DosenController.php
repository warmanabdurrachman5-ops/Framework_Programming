<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use App\Services\ImageUploadService;

class DosenController extends Controller
{
    public function __construct(private ImageUploadService $imageUpload)
    {

    }
    public function index(): View
    {
        $dosen = Dosen::all();

        return view('dosen.index', compact('dosen'));
    }

    public function create(): View
    {
        return view('dosen.create');
    }

   public function store(Request $request): RedirectResponse
{
    $validated = $this->validateDosen($request);

    if ($request->hasFile('foto')) {
        $hasilUpload = $this->imageUpload
            ->store($request->file('foto'));

        $validated['foto'] = $hasilUpload['foto'];
    }

    Dosen::create($validated);

    return redirect()
        ->route('dosen.index')
        ->with('success', 'Data dosen berhasil ditambahkan.');
}

    public function edit(Dosen $dosen): View
    {
        return view('dosen.edit', compact('dosen'));
    }
  public function update(Request $request, Dosen $dosen): RedirectResponse
{
    $validated = $this->validateDosen($request, $dosen);

    if ($request->hasFile('foto')) {

        $fotoLama = $dosen->foto;

        $hasilUpload = $this->imageUpload
            ->store($request->file('foto'));

        $validated['foto'] = $hasilUpload['foto'];

        $this->imageUpload->delete($fotoLama);
    }

    $dosen->update($validated);

    return redirect()
        ->route('dosen.index')
        ->with('success', 'Data dosen berhasil diubah.');
}
    
    public function destroy(Dosen $dosen): RedirectResponse
    {
        $this->imageUpload->delete($dosen->foto);
        $dosen->delete();

        return redirect()
            ->route('dosen.index')
            ->with('success', 'Data dosen berhasil dihapus.');
    }
    private function validateDosen(Request $request, ?Dosen $dosen =null): array
    {
        return $request->validate([
            'nidn' => [
                'required',
                'string',
                'max:20',
                Rule::unique('dosen', 'nidn')->ignore($dosen?->id),
            ],
            'nama' => ['required', 'string', 'max:100'],
            'bidang_keahlian' => ['required', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:100'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'foto'=> ['nullable','image','mimes:jpeg,jpg,png,webp','max:2048']
        ],
        ['nidn.required' => 'nidn wajib diisi.',
        'nidn.unique' => 'nidn sudah di gunakan',
        'nama.required' => 'nama wajib di ini.',
        'bidang_keahlian.required' => 'Bidang Keahlian wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'np_telepon.exists' => 'No.Telepon yang di pilih tidak valid.',
        'foto.image' => 'foto harus berupa gambar.',
        'foto.mimes' => 'foto harus berformat JPG, PNG, atau WebP.',
        'foto.max' => 'Ukuran foto maximal 2 MB.',]
        );
        
    }
}