<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Announcement;

class AnnouncementImageController extends Controller
{
    public function __invoke(Announcement $announcement, string $directory, string $filename)
    {
        abort_unless(Announcement::visibleToStudents()->whereKey($announcement->id)->exists(), 404);
        abort_unless(in_array($directory, ['media', 'images'])
            && preg_match('/^[a-zA-Z0-9_-]+\.(png|jpe?g|gif|webp)$/i', $filename), 404);
        abort_unless(str_contains($announcement->content ?? '', '/announcements/'.$directory.'/'.$filename), 404);

        $root = realpath(config('announcements.media_root').'/'.$directory);
        $path = $root ? realpath($root.'/'.$filename) : false;
        abort_unless($path && str_starts_with($path, $root.DIRECTORY_SEPARATOR) && is_file($path), 404);
        $mime = (new \finfo(FILEINFO_MIME_TYPE))->file($path);
        abort_unless(in_array($mime, ['image/png', 'image/jpeg', 'image/gif', 'image/webp']), 404);

        return response()->file($path, [
            'Content-Type' => $mime,
            'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => 'private, no-cache',
        ]);
    }
}
