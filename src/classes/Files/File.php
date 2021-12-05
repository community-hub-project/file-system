<?php
declare(strict_types=1);

namespace CommunityHub\FileSystem\Files;

use CommunityHub\FileSystem\Exception;
use CommunityHub\FileSystem\Path;

use function file_put_contents;
use function sprintf;
use function unlink;

abstract class File extends Path
{
    /**
     * @throws Exception
     */
    public function write(string $contents): static
    {
        if (false === @file_put_contents($this->getPath(), $contents)) {
            throw new Exception(sprintf(
                'File could not be written to: %s.',
                $this->getPath()
            ));
        }
    }

    /**
     * @throws Exception
     */
    public function delete(): void
    {
        if (false === unlink($this->getPath())) {
            throw new Exception(sprintf(
                'File could not be deleted: %s.',
                $this->getPath()
            ));
        }
    }
}
