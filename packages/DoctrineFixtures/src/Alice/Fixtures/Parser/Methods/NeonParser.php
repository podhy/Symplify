<?php declare(strict_types=1);

namespace Symplify\DoctrineFixtures\Alice\Fixtures\Parser\Methods;

use Nelmio\Alice\Fixtures\Parser\Methods\Base;
use Nette\DI\Config\Helpers;
use Nette\Neon\Neon;

final class NeonParser extends Base
{
    /**
     * @var string
     */
    protected $extension = 'neon';

    /**
     * @param string $file
     * @return mixed[]
     */
    public function parse($file): array
    {
        ob_start();

        // isolates the file from current context variables and gives
        // it access to the $loader object to inline php blocks if needed
        $includeWrapper = function () use ($file) {
            return include $file;
        };
        $data = $includeWrapper();

        if ($data === 1) {
            // include didn't return data but included correctly, parse it as yaml
            $neon = ob_get_clean();
            $data = Neon::decode($neon) ?: [];
        } else {
            // make sure to clean up if there is a failure
            ob_end_clean();
        }

        return $this->processIncludes($data, $file);
    }

    /**
     * @param mixed[] $data
     * @param string $filename
     * @return mixed[]
     */
    protected function processIncludes($data, $filename): array
    {
        $includeKeywords = [
            'include',
            'includes' // BC
        ];
        foreach ($includeKeywords as $includeKeyword) {
            $data = $this->mergeIncludedFiles($data, $filename, $includeKeyword);
        }

        return $data;
    }

    private function mergeIncludedFiles(array $data, string $filename, string $includeKeyword): array
    {
        if (isset($data[$includeKeyword])) {
            foreach ($data[$includeKeyword] as $include) {
                $includeFile = dirname($filename) . DIRECTORY_SEPARATOR . $include;
                $includeData = $this->parse($includeFile);
                $data = Helpers::merge($includeData, $data);
            }
            unset($data[$includeKeyword]);
        }
        return $data;
    }
}
