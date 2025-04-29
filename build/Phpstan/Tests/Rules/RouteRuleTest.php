<?php

namespace DaveLiddament\CustomPhpstanRulesTalkDemo\Build\Phpstan\Tests\Rules;

use DaveLiddament\CustomPhpstanRulesTalkDemo\Build\Phpstan\Rules\RouteRule;
use DaveLiddament\PhpstanRuleTestHelper\AbstractRuleTestCase;
use PHPStan\Rules\Rule;

/** @extends AbstractRuleTestCase<RouteRule> */
final class RouteRuleTest extends AbstractRuleTestCase
{

    protected function getRule(): Rule
    {
        return new RouteRule();
    }

    public function testUrls(): void
    {
        $this->assertIssuesReported(__DIR__ . '/Fixtures/routeUrls.php');
    }
}