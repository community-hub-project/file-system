<?php
declare(strict_types=1);

return call_user_func(function (): void {
    static $loaded = false;

    if ($loaded) {
        return;
    }

    if (!class_exists(\CommunityHub\FileSystem\Path::class, false)) {
        require __DIR__ . '/classes/Path.php';
    }

    if (!class_exists(\CommunityHub\FileSystem\Files\File::class, false)) {
        require __DIR__ . '/classes/Files/File.php';
    }

    if (!class_exists(\CommunityHub\FileSystem\Files\TextFile::class, false)) {
        require __DIR__ . '/classes/Files/TextFile.php';
    }

    $loaded = true;
});
