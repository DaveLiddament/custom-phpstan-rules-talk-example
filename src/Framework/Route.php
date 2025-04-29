<?php

namespace DaveLiddament\CustomPhpstanRulesTalkDemo\Framework;

final class Route
{
    /**
     * @param array{class-string, string}|string|callable|null $action
     */
    public static function get(string $uri, array|string|callable|null $action = null): void
    {
    }

    /**
     * @param array{class-string, string}|string|callable|null $action
     */
    public static function post(string $name, array|string|callable|null $action = null): void
    {
    }

    /**
     * @param array{class-string, string}|string|callable|null $action
     */
    public static function put(string $name, array|string|callable|null $action = null): void
    {
    }

    /**
     * @param array{class-string, string}|string|callable|null $action
     */
    public static function delete(string $name, array|string|callable|null $action = null): void
    {
    }
}