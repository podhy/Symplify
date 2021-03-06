# Doctrine Fixtures

[![Build Status](https://img.shields.io/travis/Symplify/DoctrineFixtures.svg?style=flat-square)](https://travis-ci.org/Symplify/DoctrineFixtures)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/Symplify/DoctrineFixtures.svg?style=flat-square)](https://scrutinizer-ci.com/g/Symplify/DoctrineFixtures)
[![Downloads](https://img.shields.io/packagist/dt/symplify/doctrine-fixtures.svg?style=flat-square)](https://packagist.org/packages/symplify/doctrine-fixtures)


Integration of [nelmio/alice](https://github.com/nelmio/alice) to Nette DI.
This package adds `.neon` support to Alice.

Alice uses [fzaninotto/Faker](https://github.com/fzaninotto/Faker) to generate fake data, so be sure to check that too.


## Install

```sh
composer require symplify/doctrine-fixtures
```

Register extensions:

```yaml
# app/config/config.neon
extensions:
	- Kdyby\Annotations\DI\AnnotationsExtension
	- Kdyby\Events\DI\EventsExtension
	doctrine: Kdyby\Doctrine\DI\OrmExtension
	fixtures: Symplify\DoctrineFixtures\DI\FixturesExtension
```


## Configuration

```yaml
# default values
fixtures:
	locale: "cs_CZ" # e.g. change to en_US in case you want to use English
	seed: 1
```

For all supported locales, just check [Faker Providers](https://github.com/fzaninotto/Faker/tree/master/src/Faker/Provider).


## Usage

We can load `.neon`/`.yaml` with specific fixtures structure. Alice turns them into entities and inserts them to database. To understand fixture files, just check the [README of nelmio/alice](https://github.com/nelmio/alice).

For example, this fixture will create 100 products with generated name:

`fixtures/products.neon`

```yaml
Symplify\DoctrineFixtures\Tests\Entity\Product:
	"product{1..100}":
		__construct: ["<shortName()>"]
```

### You can also include other fixtures

`fixtures/products.neon`

```yaml
include:
	- categories.neon

Symplify\DoctrineFixtures\Tests\Entity\Product:
	"product{1..100}":
		__construct: ["<shortName()>"]
		category: "@category@brand<numberBetween(1, 10)>"
```

`fixtures/categories.neon`

```yaml
Symplify\DoctrineFixtures\Tests\Entity\Category:
	"category{1..10}":
		__construct: ["<shortName()>"]
```


And then we can load them:

```php
use Symplify\DoctrineFixtures\Contract\Alice\AliceLoaderInterface;


class SomeClass
{

	/**
	 * @var AliceLoaderInterface
	 */
	private $aliceLoader;


	public function __construct(AliceLoaderInterface $aliceLoader)
	{
		$this->aliceLoader = $aliceLoader;
	}
	
	
	public function loadFixtures()
	{
		// arg can be used file(s) or dir(s) with fixtures
		$entities = $this->aliceLoader->load(__DIR__ . '/fixtures');
		// ...
	}

}
```

That's it!


## Contributing

Send [issue](https://github.com/Symplify/Symplify/issues) or [pull-request](https://github.com/Symplify/Symplify/pulls) to main repository.