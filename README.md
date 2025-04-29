# Example of adding a Custom PHPStan rule to a project to enforce a coding standard

This is a supporting library for my talk on creating custom PHPStan rules.

It demonstrates two things:

1. How to create a custom PHPStan rule to enforce coding standards
2. How to use custom rules to help with upgrading a library


## Enforcing Coding Standards

See the custom PHPStan rule `build/Phpstan/Rules/RouteRule.php`.

This enforces the following coding route related standards:

#### 1. URLs must use kebab-case

Correct:
```
https://example.com/talks/custom-phpstan-rules
```

Incorrect:
```
https://example.com/talks/CustomPhpstanRules
```


#### 2. Use route tuple notation when specifying controllers

Correct:
```php
Route::get('/talks/custom-phpstan-rules', [TalkController::class, 'show']);
```

Incorrect:
```php
Route::get('/talks/custom-phpstan-rules', 'TalkController@show');
```


### Demo

Install via composer and then run the following command:

```bash
vendor/bin/phpstan analyse
```

Look at the errors it shows in the `api.php` file. See how it is enforcing the coding standards.


## Upgrading a Library

In order to upgrade from v1 to v2 of [this demo library](https://github.com/DaveLiddament/custom-phpstan-rules-talk-demo-library).

We will use the custom PHPStan rule in [this repo](https://github.com/DaveLiddament/custom-phpstan-rules-talk-demo-upgrade-rule) to show all the places in the code where the library is using the old v1 API.

To fix you need to add a second argument to the `AlertService::alert()` method. This is a new required argument in v2 of the library.



To see just the places where the library is using the old v1 API, run the following command:

```bash
vendor/bin/phpstan analyse -c phpstan-upgrade.neon
```