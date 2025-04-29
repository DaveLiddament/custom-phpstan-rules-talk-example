<?php

namespace DaveLiddament\CustomPhpstanRulesTalkDemo\Build\Phpstan\Tests\Helpers;

use DaveLiddament\CustomPhpstanRulesTalkDemo\Build\Phpstan\Helpers\RouteValidator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RouteValidatorTest extends TestCase
{
    /** @return list<array{bool, string}> */
    public static function dataProvider(): array
    {
        return [
            [true, '/hello'],
            [true, '/hello/{name}'],
            [true, '/say-hello/{firstName}'],
            [false, '/sayHello/{firstName}'],
            [false, '/say-hello/{first-name}'],
        ];
    }

    #[Test]
    #[DataProvider('dataProvider')]
    public function testRouteValidator(bool $expected, string $route): void
    {
        $result = RouteValidator::validate($route);

        self::assertSame($expected, $result);
    }
}