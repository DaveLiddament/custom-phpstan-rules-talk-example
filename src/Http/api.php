<?php


use DaveLiddament\CustomPhpstanRulesTalkDemo\Framework\Route;
use DaveLiddament\CustomPhpstanRulesTalkDemo\Http\WelcomeController;

Route::get('/hello', [WelcomeController::class, 'hello']);
Route::get('/hello/{name}', [WelcomeController::class, 'hello']);
Route::get('/say-hello/{firstName}', [WelcomeController::class, 'hello']);


Route::get('/sayHello/{firstName}', [WelcomeController::class, 'hello']); // ERROR URL must by in kebab-case and any parameters in camelCase

Route::get('/say-hello/{firstName}', 'WelcomeControllerhello'); // ERROR Use tuple syntax for controller


