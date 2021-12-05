<?php
declare(strict_types=1);

namespace CommunityHub\FileSystem;

use function sprintf;
use function mkdir;

final class Directory extends Path
{
    /**
     * @throws Exception
     */
    public function create(): self
    {
        if (false === mkdir($this->getPath(), 0755, true)) {
            throw new Exception(sprintf(
                'Directory could not be created to: %s.',
                $this->getPath()
            ));
        }
    }
}
