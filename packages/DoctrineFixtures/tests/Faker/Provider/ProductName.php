<?php declare(strict_types=1);

namespace Symplify\DoctrineFixtures\Tests\Faker\Provider;

use Faker\Provider\Base;

final class ProductName extends Base
{
    /**
     * @var string[]
     */
    public static $randomNames = [
        'Hair of love',
        'Eye of xray',
        'Flying shoe'
    ];

    public function shortName(): string
    {
        return $this->randomElement(self::$randomNames);
    }
}
