<?php
declare(strict_types=1);

namespace CommunityHub\FileSystem;

use function array_reduce;
use function array_merge;
use function array_shift;
use function str_replace;
use function in_array;
use function realpath;
use function explode;
use function implode;
use function sprintf;
use function strlen;
use function count;

use const PHP_MAXPATHLEN;

abstract class Path
{
    private string $path;

    /**
     * @throws Exception
     */
    public function __construct(string $prefix, string $path)
    {
        $this->path = $prefix . $this->format($path);

        if (strlen($this->path) > PHP_MAXPATHLEN) {
            throw new Exception(sprintf(
                'Path exceeds maximum path length: %s.',
                $this->path
            ));
        }
    }

    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @throws Exception
     */
    private function format(string $path): string
    {
        $formatted = realpath($path);
        if (false !== $formatted) {
            return $formatted;
        }

        $path = str_replace('\\', '/', $path);

        $segments = array_reduce(explode('/', $path), function (array $segments, string $segment) use ($path): array {
            if (in_array($segment, ['', '.'])) {
                return $segments;
            }

            if ('..' === $segment) {
                if (0 === count($segments)) {
                    throw new Exception('Invalid Path: %s.', $path);
                }

                array_shift($segments);

                return $segments;
            }

            return array_merge($segments, [$segment]);
        }, []);

        return implode('/', $segments);
    }
}
