<?php

namespace DaveLiddament\CustomPhpstanRulesTalkDemo\Build\Phpstan\Rules;

use DaveLiddament\CustomPhpstanRulesTalkDemo\Build\Phpstan\Helpers\RouteValidator;
use DaveLiddament\CustomPhpstanRulesTalkDemo\Framework\Route;
use PhpParser\Node;
use PhpParser\Node\Expr\StaticCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\IdentifierRuleError;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleError;
use PHPStan\Rules\RuleErrorBuilder;
use function _PHPStan_95d365e52\Symfony\Component\String\u;

/** @implements Rule<StaticCall> */
final class RouteRule implements Rule
{

    public function getNodeType(): string
    {
        return StaticCall::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        // 1. Check if the class we are calling is the Route class
        if (!$node->class instanceof Node\Name) {
            return [];
        }
        if ($node->class->toString() !== Route::class) {
            return [];
        }

        // 2. Check if the method called is one of get, post, put, delete
        if (!($node->name instanceof Node\Identifier)) {
            return [];
        }
        $methodName = $node->name->toLowerString();
        if (!in_array($methodName, ['get', 'post', 'put', 'delete'], true)) {
            return [];
        }

        $errors = [];

        // 3. Check if URL is valid
        $routeUrlError = $this->isValidRoute($node);
        if ($routeUrlError !== null) {
            $errors[] = $routeUrlError;
        }

        // 4. Check tuple notation used
        $tupleNotationError = $this->isTupleNotation($node, $scope);
        if ($tupleNotationError !== null) {
            $errors[] = $tupleNotationError;
        }

        return $errors;

    }

    private function isValidRoute(StaticCall $node): ?IdentifierRuleError
    {
        // 3. Get the 1st arguments value (if one is supplied)
        // Check if the first argument is an Arg (rather than not existing or being a Variadic)
        $arg = $node->args[0] ?? null;
        if (!$arg instanceof Node\Arg) {
            return null;
        }

        // Check if the first argument is a string
        $value = $arg->value;
        if (!$value instanceof Node\Scalar\String_) {
            return null;
        }

        // 4. Check if the value is a valid URL
        if (RouteValidator::validate($value->value)) {
            return null;
        }

        // 5. Return an error if the URL is not valid
        return RuleErrorBuilder::message('URL must be in kebab-case and any parameters in camelCase')
                ->identifier('route.url')
                ->build();
    }

    private function isTupleNotation(StaticCall $node, Scope $scope): ?IdentifierRuleError
    {
        $arg = $node->args[1] ?? null;
        if (!$arg instanceof Node\Arg) {
            return null;
        }

        if ($scope->getType($arg->value)->isArray()->no()) {
            return RuleErrorBuilder::message('Use tuple syntax for controller')
                ->identifier('route.tupleNotation')
                ->build();
        };

        return null;
    }
}