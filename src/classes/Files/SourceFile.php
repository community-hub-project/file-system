<?php
declare(strict_types=1);

namespace CommunityHub\FileSystem\Files;

use CommunityHub\FileSystem\Exception;

use Throwable;

use function function_exists;
use function file_exists;
use function sprintf;

final class SourceFile extends File
{
    /**
     * @throws Exception
     */
    public function run(): mixed
    {
        try {
            require $this->getPath();
        } catch (Throwable $e) {
            $path = $this->getPath();

            if (file_exists($path)) {
                throw new Exception(sprintf(
                    'File could not be executed: %s.',
                    $path
                ));
            }

            throw $e;
        }
    }

    /**
     * @throws Exception
     */
    public function write(string $contents): static
    {
        parent::write($contents);

        $this->invalidate();

        return $this;
    }

    /**
     * @throws Exception
     */
    public function delete(): void
    {
        parent::delete();

        $this->invalidate();
    }

    private function invalidate(): void
    {
        if (function_exists('opcache_invalidate')) {
            \opcache_invalidate($this->getPath(), true);
        }
    }
}
