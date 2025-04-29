<?php

namespace DaveLiddament\CustomPhpstanRulesTalkDemo\Build\Phpstan\Helpers;

final class RouteValidator
{
    public static function validate(string $route): bool
    {
        $segments = explode('/', trim($route, '/'));

        foreach ($segments as $segment) {
            if (preg_match('/^{(.+)}$/', $segment, $matches)) {
                // It's a parameter inside {}
                $param = $matches[1];

                // Must be camelCase: no dashes or underscores, starts with lowercase letter
                if (!preg_match('/^[a-z][a-zA-Z0-9]*$/', $param)) {
                    return false;
                }
            } else {
                // Normal path segment: must be kebab-case
                // Only lowercase letters, numbers, and dashes, and no consecutive dashes
                if (!preg_match('/^[a-z0-9]+(-[a-z0-9]+)*$/', $segment)) {
                    return false;
                }
            }
        }

        return true;
    }
}