<?php declare(strict_types=1);

namespace Symplify\CodingStandard\TokenWrapper;

use Nette\Utils\Strings;
use PHP_CodeSniffer\Files\File;
use Symplify\CodingStandard\Helper\TokenFinder;

final class MethodWrapper
{
    /**
     * @var File
     */
    private $file;

    /**
     * @var int
     */
    private $position;

    /**
     * @var mixed[]
     */
    private $tokens;

    /**
     * @var string
     */
    private $methodName;

    /**
     * @var ParameterWrapper[]
     */
    private $parameters;

    /**
     * @var mixed[]
     */
    private $methodToken;

    /**
     * @var int
     */
    private $startPosition;

    /**
     * @var int
     */
    private $endPosition;

    private function __construct(File $file, int $position)
    {
        $this->file = $file;
        $this->position = $position;

        $this->tokens = $this->file->getTokens();

        $namePointer = TokenFinder::findNextEffective($file, $this->position + 1);
        $this->methodName = $this->tokens[$namePointer]['content'];

        $this->methodToken = $this->tokens[$position];

        $this->startPosition = $this->position - 2; // todo: start position
        $this->endPosition = (int) $this->methodToken['scope_closer'];
    }

    public static function createFromFileAndPosition(File $file, int $position): self
    {
        return new self($file, $position);
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function hasNamePrefix(string $prefix): bool
    {
        return Strings::startsWith($prefix, $this->methodName);
    }

    /**
     * @return ParameterWrapper[]
     */
    public function getParameters(): array
    {
        if ($this->parameters) {
            return $this->parameters;
        }

        $parameterPositions = TokenFinder::findAllOfType(
            $this->file, T_VARIABLE, $this->methodToken['parenthesis_opener'], $this->methodToken['parenthesis_closer']
        );

        $parameters = [];
        foreach ($parameterPositions as $paramterPosition) {
            $parameters[] = ParameterWrapper::createFromFileAndPosition($this->file, $paramterPosition);
        }

        return $this->parameters = $parameters;
    }

    public function remove(): void
    {
        for ($i = $this->startPosition - 2; $i <= $this->endPosition + 1; $i++) {
            $this->file->fixer->replaceToken($i, '');
        }
    }
}
