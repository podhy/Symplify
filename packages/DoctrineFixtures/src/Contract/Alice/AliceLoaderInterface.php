<?php declare(strict_types=1);

namespace Symplify\DoctrineFixtures\Contract\Alice;

interface AliceLoaderInterface
{
    /**
     * Loads fixtures from one or more files/folders.
     *
     * @param string|string[] $sources
     * @return object[]
     */
    public function load($sources): array;
}
