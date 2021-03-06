<?php declare(strict_types=1);

namespace Symplify\DefaultAutowire\Tests\Source;

final class SomeServiceWithOptionalConstructorArguments
{
    /**
     * @var SomeService
     */
    private $someService;

    /**
     * @var mixed[]
     */
    private $arg = [];

    /**
     * @param SomeService $someService
     * @param mixed[] $arg
     */
    public function __construct(?SomeService $someService, array $arg = [])
    {
        $this->someService = $someService;
        $this->arg = $arg;
    }

    public function getSomeService(): SomeService
    {
        return $this->someService;
    }

    /**
     * @return mixed[]
     */
    public function getArg(): array
    {
        return $this->arg;
    }
}
