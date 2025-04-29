<?php

namespace DaveLiddament\CustomPhpstanRulesTalkDemo\Http;

class WelcomeController
{
    public function sayHello(): string
    {
        return 'Hello';
    }

    public function sayHelloWithName(string $name): string
    {
        return 'Hello ' . $name;
    }
}