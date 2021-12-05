<?php
declare(strict_types=1);

namespace CommunityHub\FileSystem;

use CommunityHub\FileSystem\Files\SourceFile;
use CommunityHub\FileSystem\Files\TextFile;

use function call_user_func;

/**
 * @throws Exception
 */
function create_directory(string $path): Directory
{
    call_user_func(require __DIR__ . '/load_directory.php');

    return new Directory($path);
}

/**
 * @throws Exception
 */
function create_source_file(string $path): SourceFile
{
    call_user_func(require __DIR__ . '/load_source_file.php');

    return new SourceFile($path);
}

/**
 * @throws Exception
 */
function create_text_file(string $path): TextFile
{
    call_user_func(require __DIR__ . '/load_text_file.php');

    return new TextFile($path);
}
