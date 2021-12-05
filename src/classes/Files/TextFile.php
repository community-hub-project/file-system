<?php
declare(strict_types=1);

namespace CommunityHub\FileSystem\Files;

use CommunityHub\FileSystem\Exception;

use function file_get_contents;
use function sprintf;

final class TextFile extends File
{
    /**
     * @throws Exception
     */
    public function read(): string
    {
        $contents = file_get_contents($this->getPath());

        if (false === $contents) {
            throw new Exception(sprintf(
                'File could not be read from: %s.',
                $this->getPath()
            ));
        }

        return $contents;
    }
}
