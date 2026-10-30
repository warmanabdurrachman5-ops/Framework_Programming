<?php
namespace App\Http\Controllers;
use App\Models\Dosen;
use App\Models\JadwalKuliah;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\Ruangan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class JadwalKuliahController extends Controller
{
    public function index(): View
    {
        $jadwalkuliah = JadwalKuliah::with(['kelas', 'mataKuliah', 'dosen', 'ruangan','lampiran'])->get();
        return view('jadwalkuliah.index', compact('jadwalkuliah'));
    }
    public function create(): View
    {
        $kelas = Kelas::all();
        $mataKuliah = MataKuliah::all();
        $dosen = Dosen::all();
        $ruangan = Ruangan::all();
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        return view('jadwalkuliah.create', compact('kelas', 'mataKuliah', 'dosen', 'ruangan', 'hari'));
    }
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kelas_id' => ['required', 'exists:kelas,id'],
            'matakuliah_id' => ['required', 'exists:matakuliahs,id'],
            'dosen_id' => ['required', 'exists:dosen,id'],
            'ruangan_id' => ['required', 'exists:ruangan,id'],
            'hari' => ['required', 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu'],
            'jam_mulai' => ['required', 'date_format:H:i'],
            'jam_selesai' => ['required', 'date_format:H:i', 'after:jam_mulai'],
            'lampiran' => ['nullable', 'array'],
            'lampiran.*' => ['file', 'max:5120'],
        ]);
        // Validasi bentrok ruangan
        $bentrokRuangan = JadwalKuliah::where('ruangan_id', $validated['ruangan_id'])
            ->where('hari', $validated['hari'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('jam_mulai', [$validated['jam_mulai'], $validated['jam_selesai']])
                    ->orWhereBetween('jam_selesai', [$validated['jam_mulai'], $validated['jam_selesai']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('jam_mulai', '<=', $validated['jam_mulai'])
                          ->where('jam_selesai', '>=', $validated['jam_selesai']);
                    });
            })
            ->exists();
            if ($bentrokRuangan) {
            return back()
                ->withInput()
                ->withErrors(['ruangan_id' => 'Ruangan sudah terpakai di jadwal tersebut.']);
        }
        // Validasi bentrok dosen
        $bentrokDosen = JadwalKuliah::where('dosen_id', $validated['dosen_id'])
            ->where('hari', $validated['hari'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('jam_mulai', [$validated['jam_mulai'], $validated['jam_selesai']])
                    ->orWhereBetween('jam_selesai', [$validated['jam_mulai'], $validated['jam_selesai']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('jam_mulai', '<=', $validated['jam_mulai'])
                          ->where('jam_selesai', '>=', $validated['jam_selesai']);
                    });
            })
            ->exists();
        if ($bentrokDosen) {
            return back()
                ->withInput()
                ->withErrors(['dosen_id' => 'Dosen sudah mengajar di jadwal tersebut.']);
        }
        // Validasi bentrok kelas
        $bentrokKelas = JadwalKuliah::where('kelas_id', $validated['kelas_id'])
            ->where('hari', $validated['hari'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('jam_mulai', [$validated['jam_mulai'], $validated['jam_selesai']])
                    ->orWhereBetween('jam_selesai', [$validated['jam_mulai'], $validated['jam_selesai']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('jam_mulai', '<=', $validated['jam_mulai'])
                          ->where('jam_selesai', '>=', $validated['jam_selesai']);
                    });
            })
            ->exists();
        if ($bentrokKelas) {
            return back()
                ->withInput()
                ->withErrors(['kelas_id' => 'Kelas sudah memiliki jadwal di waktu tersebut.']);
        }
       // Hapus data lampiran dari array sebelum membuat jadwal
unset($validated['lampiran']);

// Buat jadwal terlebih dahulu
$jadwalkuliah = JadwalKuliah::create($validated);

// Setelah jadwal dibuat, baru simpan lampirannya
if ($request->hasFile('lampiran')) {
    foreach ($request->file('lampiran') as $file) {
        $namaFile = Str::uuid() . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs(
            'lampiran-jadwal',
            $namaFile,
            'public'
        );

        $jadwalkuliah->lampiran()->create([
            'path' => $path,
            'nama_asli' => $file->getClientOriginalName(),
        ]);
    }
}

return redirect()
    ->route('jadwal-kuliah.index')
    ->with('success', 'Jadwal kuliah berhasil ditambahkan.');
            
    }
    public function edit(JadwalKuliah $jadwalkuliah): View
    {
        $kelas = Kelas::all();
        $mataKuliah = MataKuliah::all();
        $dosen = Dosen::all();
        $ruangan = Ruangan::all();
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        return view('jadwalkuliah.edit', compact('jadwalkuliah', 'kelas', 'mataKuliah', 'dosen', 'ruangan', 'hari'));
    }
    public function update(Request $request, JadwalKuliah $jadwalkuliah): RedirectResponse
    {
        $validated = $request->validate([
            'kelas_id' => ['required', 'exists:kelas,id'],
            'matakuliah_id' => ['required', 'exists:matakuliahs,id'],
            'dosen_id' => ['required', 'exists:dosen,id'],
            'ruangan_id' => ['required', 'exists:ruangan,id'],
            'hari' => ['required', 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu'],
            'jam_mulai' => ['required', 'date_format:H:i'],
            'jam_selesai' => ['required', 'date_format:H:i', 'after:jam_mulai'],
            'lampiran' => ['nullable', 'array'],
            'lampiran.*' => ['file', 'max:5120'],
        ]);
        // Validasi bentrok ruangan (exclude current)
        $bentrokRuangan = JadwalKuliah::where('ruangan_id', $validated['ruangan_id'])
            ->where('hari', $validated['hari'])
            ->where('id', '!=', $jadwalkuliah->id)
            ->where(function ($query) use ($validated) {
                $query->whereBetween('jam_mulai', [$validated['jam_mulai'], $validated['jam_selesai']])
                    ->orWhereBetween('jam_selesai', [$validated['jam_mulai'], $validated['jam_selesai']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('jam_mulai', '<=', $validated['jam_mulai'])
                          ->where('jam_selesai', '>=', $validated['jam_selesai']);
                    });
            })
            ->exists();
        if ($bentrokRuangan) {
            return back()
                ->withInput()
                ->withErrors(['ruangan_id' => 'Ruangan sudah terpakai di jadwal tersebut.']);
        }
        // Validasi bentrok dosen (exclude current)
        $bentrokDosen = JadwalKuliah::where('dosen_id', $validated['dosen_id'])
            ->where('hari', $validated['hari'])
            ->where('id', '!=', $jadwalkuliah->id)
            ->where(function ($query) use ($validated) {
                $query->whereBetween('jam_mulai', [$validated['jam_mulai'], $validated['jam_selesai']])
                    ->orWhereBetween('jam_selesai', [$validated['jam_mulai'], $validated['jam_selesai']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('jam_mulai', '<=', $validated['jam_mulai'])
                          ->where('jam_selesai', '>=', $validated['jam_selesai']);
                    });
            })
            ->exists();
            if ($bentrokDosen) {
            return back()
                ->withInput()
                ->withErrors(['dosen_id' => 'Dosen sudah mengajar di jadwal tersebut.']);
        }
        // Validasi bentrok kelas (exclude current)
        $bentrokKelas = JadwalKuliah::where('kelas_id', $validated['kelas_id'])
            ->where('hari', $validated['hari'])
            ->where('id', '!=', $jadwalkuliah->id)
            ->where(function ($query) use ($validated) {
                $query->whereBetween('jam_mulai', [$validated['jam_mulai'], $validated['jam_selesai']])
                    ->orWhereBetween('jam_selesai', [$validated['jam_mulai'], $validated['jam_selesai']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('jam_mulai', '<=', $validated['jam_mulai'])
                          ->where('jam_selesai', '>=', $validated['jam_selesai']);
                    });
            })
            ->exists();
        if ($bentrokKelas) {
            return back()
                ->withInput()
                ->withErrors(['kelas_id' => 'Kelas sudah memiliki jadwal di waktu tersebut.']);
        }

     // Hilangkan data lampiran dari array validasi
unset($validated['lampiran']);

// Update jadwal yang sedang diedit
$jadwalkuliah->update($validated);

// Tambahkan lampiran baru jika pengguna memilih file
if ($request->hasFile('lampiran')) {
    foreach ($request->file('lampiran') as $file) {
        $namaFile = Str::uuid() . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs(
            'lampiran-jadwal',
            $namaFile,
            'public'
        );

        $jadwalkuliah->lampiran()->create([
            'path' => $path,
            'nama_asli' => $file->getClientOriginalName(),
        ]);
    }
}

return redirect()
    ->route('jadwal-kuliah.index')
    ->with('success', 'Jadwal kuliah berhasil diubah.');
    }
  public function destroy(JadwalKuliah $jadwalkuliah): RedirectResponse
{
    $daftarFile = $jadwalkuliah->lampiran()
        ->pluck('path')
        ->all();

    // Menghapus jadwal sekaligus baris lampiran melalui cascade
    $jadwalkuliah->delete();

    // Menghapus file fisik
    Storage::disk('public')->delete($daftarFile);

    return redirect()
        ->route('jadwal-kuliah.index')
        ->with('success', 'Jadwal dan lampiran berhasil dihapus.');
}
}