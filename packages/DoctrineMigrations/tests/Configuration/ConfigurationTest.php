<?php declare(strict_types=1);

namespace Symplify\DoctrineMigrations\Tests\Configuration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Doctrine\DBAL\Migrations\Version;
use PHPUnit\Framework\TestCase;
use Symplify\DoctrineMigrations\Tests\Configuration\ConfigurationSource\SomeService;
use Symplify\DoctrineMigrations\Tests\ContainerFactory;
use Symplify\DoctrineMigrations\Tests\Migrations\Version123;

final class ConfigurationTest extends TestCase
{
    /**
     * @var Configuration
     */
    private $configuration;

    protected function setUp(): void
    {
        $container = (new ContainerFactory)->create();
        $this->configuration = $container->getByType(Configuration::class);

        $this->configuration->registerMigrationsFromDirectory(
            $this->configuration->getMigrationsDirectory()
        );
    }

    public function testInject(): void
    {
        $migrations = $this->configuration->getMigrationsToExecute('up', (string) 123);
        $this->assertCount(1, $migrations);

        /** @var Version $version */
        $version = $migrations[123];
        $this->assertInstanceOf(Version::class, $version);

        /** @var AbstractMigration|Version123 $migration */
        $migration = $version->getMigration();
        $this->assertInstanceOf(AbstractMigration::class, $migration);

        $this->assertInstanceOf(SomeService::class, $migration->someService);
    }

    public function testLoadMigrationsFromSubdirs(): void
    {
        $migrations = $this->configuration->getMigrations();
        $this->assertCount(2, $migrations);
    }
}
