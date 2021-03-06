<?php declare(strict_types=1);

namespace Symplify\DoctrineBehaviors\Tests\Translatable\Entities\Attributes;

use PHPUnit\Framework\TestCase;
use Symplify\DoctrineBehaviors\Tests\Translatable\Entities\Attributes\Source\TranslatableEntity;

final class TranslatableTest extends TestCase
{
    public function testGetterMethod(): void
    {
        $translatableEntity = new TranslatableEntity;
        $this->assertSame('someName', $translatableEntity->getName());
    }

    public function testProperty(): void
    {
        $translatableEntity = new TranslatableEntity;
        $this->assertSame(5, $translatableEntity->position);
    }
}
