<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class WebpImage
{
    public static function store(UploadedFile $file, string $directory, string $disk = 'public', int $quality = 82): string
    {
        $sourcePath = $file->getRealPath();

        if (! $sourcePath || ! is_file($sourcePath)) {
            throw new RuntimeException('Không đọc được file ảnh upload.');
        }

        $image = static::createImageResource($sourcePath, $file->getMimeType() ?: '');

        if (! $image) {
            throw new RuntimeException('Định dạng ảnh không được hỗ trợ.');
        }

        if (! imageistruecolor($image)) {
            imagepalettetotruecolor($image);
        }

        imagealphablending($image, true);
        imagesavealpha($image, true);

        $tmpPath = tempnam(sys_get_temp_dir(), 'webp_');
        if ($tmpPath === false) {
            imagedestroy($image);
            throw new RuntimeException('Không tạo được file tạm để convert ảnh.');
        }

        try {
            if (! imagewebp($image, $tmpPath, $quality)) {
                throw new RuntimeException('Không convert được ảnh sang webp.');
            }

            $filename = trim($directory, '/').'/'.uniqid('', true).'.webp';
            Storage::disk($disk)->put($filename, file_get_contents($tmpPath));

            return $filename;
        } finally {
            imagedestroy($image);

            if (is_file($tmpPath)) {
                @unlink($tmpPath);
            }
        }
    }

    private static function createImageResource(string $path, string $mime)
    {
        return match ($mime) {
            'image/jpeg', 'image/jpg' => imagecreatefromjpeg($path),
            'image/png' => imagecreatefrompng($path),
            'image/gif' => imagecreatefromgif($path),
            'image/webp' => imagecreatefromwebp($path),
            default => static::createImageResourceByExtension($path),
        };
    }

    private static function createImageResourceByExtension(string $path)
    {
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return match ($extension) {
            'jpeg', 'jpg' => imagecreatefromjpeg($path),
            'png' => imagecreatefrompng($path),
            'gif' => imagecreatefromgif($path),
            'webp' => imagecreatefromwebp($path),
            default => false,
        };
    }
}
