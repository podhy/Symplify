<?php declare(strict_types=1);

namespace Symplify\Statie\Tests\Console;

use PHPUnit\Framework\TestCase;
use Symplify\Statie\Console\ConsoleApplication;

final class ConsoleApplicationTest extends TestCase
{
    /**
     * @var ConsoleApplication
     */
    private $consoleApplication;

    protected function setUp(): void
    {
        $this->consoleApplication = new ConsoleApplication;
    }

    public function testGetLongVersion(): void
    {
        $this->assertContains(
            'Statie - Static Site Generator',
            $this->consoleApplication->getLongVersion()
        );
    }

    public function testGetDefaultOptions(): void
    {
        $definition = $this->consoleApplication->getDefinition();
        $this->assertSame(1, $definition->getArgumentCount());
        $this->assertTrue($definition->hasOption('help'));
    }
}
