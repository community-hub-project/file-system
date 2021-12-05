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

    if (!class_exists(\CommunityHub\FileSystem\Directory::class, false)) {
        require __DIR__ . '/classes/Directory.php';
    }

    $loaded = true;
});
