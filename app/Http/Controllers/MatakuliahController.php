<?php
namespace App\Http\Controllers;
use App\Models\MataKuliah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class MataKuliahController extends Controller
{

    public function index(): View
    {
        $matakuliah = MataKuliah::all();
        return view('matakuliah.index', compact('matakuliah'));
    }
    public function create(): View
    {
        return view('matakuliah.create');
    }

public function store(Request $request): RedirectResponse
{
    $validated = $this->validateMatakuliah($request);

    if ($request->hasFile('modul')) {
        $namaFile = Str::uuid() . '.pdf';

        $validated['modul'] = $request->file('modul')
            ->storeAs('modul', $namaFile, 'public');
    }

    MataKuliah::create($validated);

    return redirect()
        ->route('mata-kuliah.index')
        ->with('success', 'Data mata kuliah berhasil ditambahkan.');
}
    public function edit(MataKuliah $matakuliah): View
    {
        return view('matakuliah.edit', compact('matakuliah'));
    }
   
public function update(Request $request, MataKuliah $matakuliah): RedirectResponse
{
    // 1. Validasi data
    $validated = $this->validateMatakuliah($request, $matakuliah);

    // 2. Hilangkan input file dari data validasi
    unset($validated['modul']);

    // 3. Ambil path modul lama
    $modulLama = $matakuliah->modul;
    $modulBaru = null;
    $hapusModulLama = false;

    // 4. Jika pengguna mengunggah PDF baru
    if ($request->hasFile('modul')) {
        $namaFile = Str::uuid() . '.pdf';

        $modulBaru = $request->file('modul')
            ->storeAs('modul', $namaFile, 'public');

        $validated['modul'] = $modulBaru;
    }

    // 5. Jika pengguna memilih hapus modul
    elseif ($request->boolean('hapus_modul') && $modulLama) {
        $validated['modul'] = null;
        $hapusModulLama = true;
    }

    // 6. Simpan perubahan ke database
    try {
        $matakuliah->update($validated);
    } catch (\Throwable $e) {
        // Hapus file baru jika update gagal
        if ($modulBaru) {
            Storage::disk('public')->delete($modulBaru);
        }

        throw $e;
    }

    // 7. Hapus file lama jika diganti atau dihapus
    if (($modulBaru || $hapusModulLama) && $modulLama) {
        Storage::disk('public')->delete($modulLama);
    }

    return redirect()
        ->route('mata-kuliah.index')
        ->with('success', 'Data mata kuliah berhasil diubah.');
}


    public function destroy(MataKuliah $matakuliah): RedirectResponse
    {
         $pathModul = $matakuliah->modul;


    // Hapus file jika data berhasil dihapus.
    if ($pathModul) {
        Storage::disk('public')->delete($pathModul);
    }
        $matakuliah->delete();
        return redirect()
            ->route('mata-kuliah.index')
            ->with('success', 'Data mata kuliah berhasil dihapus.');
    }


private function validateMatakuliah(
    Request $request,
    ?MataKuliah $matakuliah = null
): array {
    return$request->validate([

        'kode_mk' => [ // Ubah menjadi kode_mk
            'required',
            'string',
            'max:20',
            Rule::unique('matakuliahs', 'kode_mk')->ignore($matakuliah?->id), // Sesuaikan nama tabel ke matakuliahs
        ],
        'nama_mk' => ['required', 'string', 'max:100'], // Ubah menjadi nama_mk
        'sks' => ['required', 'integer', 'min:1', 'max:10'],
        'semester' => ['required', 'integer', 'min:1', 'max:14'],
        'modul' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
    ],
     ['kode_mk.required' => 'kode_mk wajib diisi.',
        'kode_mk.unique' => 'kode_mk sudah di gunakan',
        'nama_mk.required' => 'nama_mk wajib di ini.',
        'sks.required' => 'sks wajib diisi.',
        'semester.required' => 'semester wajib diisi.',
        'modul.file' => 'modul harus berupa PDF.',
        'modul.mimes' => 'modul harus berformat PDF.',
        'modul.max' => 'Ukuran modul maximal 5 MB.',]
    );
}
}
