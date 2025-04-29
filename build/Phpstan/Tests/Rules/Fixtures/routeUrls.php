<?php

use DaveLiddament\CustomPhpstanRulesTalkDemo\Build\Phpstan\Tests\Rules\Fixtures\DummyController;
use DaveLiddament\CustomPhpstanRulesTalkDemo\Framework\Route;

Route::get('/hello', [DummyController::class, 'hello']); // OK

Route::get('/hello/{name}', [DummyController::class, 'hello']); // OK

Route::get('/say-hello/{firstName}', [DummyController::class, 'hello']); // OK

Route::get('/sayHello/{firstName}', [DummyController::class, 'hello']); // ERROR URL must be in kebab-case and any parameters in camelCase

Route::get('/sayHello/{first-name}', [DummyController::class, 'hello']); // ERROR URL must be in kebab-case and any parameters in camelCase

Route::get('/hello', 'DummyController::hello'); // ERROR Use tuple syntax for controller
