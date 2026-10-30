<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageUploadService
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    public function store(UploadedFile $file): array
    {
        $namaFile = Str::uuid() . '.webp';

        $pathFoto = 'mahasiswa/' . $namaFile;
        $pathThumb = 'mahasiswa/thumb_' . $namaFile;

        // Membuat foto utama maksimal 600px
        $foto = $this->manager->read($file->getRealPath());
        $foto->scaleDown(width: 600);

        Storage::disk('public')->put(
            $pathFoto,
            (string) $foto->toWebp(quality: 80)
        );

        // Membuat thumbnail maksimal 150px
        $thumbnail = $this->manager->read($file->getRealPath());
        $thumbnail->scaleDown(width: 150);

        Storage::disk('public')->put(
            $pathThumb,
            (string) $thumbnail->toWebp(quality: 80)
        );

        return [
            'foto' => $pathFoto,
            'foto_thumb' => $pathThumb,
        ];
    }

   public function delete(?string $path): void
{
    if (!$path) {
        return;
    }

    Storage::disk('public')->delete($path);

    $namaFile = basename($path);
    $pathThumb = 'mahasiswa/thumb_' . $namaFile;

    Storage::disk('public')->delete($pathThumb);
}
}
