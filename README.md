# CSRF

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]
![PSR 2][ico-psr2]
![PSR 4][ico-psr4]

A quick way to generate and validate CSRF Tokens and CSRF Form Fields for PHP 5.6, 7.0 and 7.1.

## Install

Via Composer

``` bash
$ composer require pascalebeier/csrf
```

## Usage
The `PascaleBeier\CSRF` Namespace exposes two Classses: `Token` and `Field`.

The `Token` Class requires a `Symfony\Component\HttpFoundation\Session\Session` and a `Symfony\Component\HttpFoundation\Request`
object for instantiation;

Instantiate the `Field` class with a `Token` Object.

Real-World example: In your bootstrapping file, using the `league/container` Container:

`composer require league/container`

``` php
<?php

use League\Container\Container;
use PascaleBeier\CSRF\Token;
use PascaleBeier\CSRF\Field;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

$c = new Container();
$c->share('session', new Session());
$c->share('request', Request::createFromGlobals());
$c->share('token', new Token($c->get('session', $c->get('request'));
$c->share('field', new Field($c->get('token');
```

In your view:

``` php
<?php $field = $container->get('field'); ?>

<form action="/storeAction" method="post">
    <?= $field->generate(); ?>
    <button type="submit">Submit</button>
</form>
```

In your Controller:

``` php

<?php


class Controller
{
    public function storeAction(Token $token, Request $request, Response $response)
    {
        if ($token->matches())
        {
            // CSRF token is valid, continue
        }
    }
...
```

## API

### Token

#### `generate(): bool|string`

Generate a new token from the user session or deploy a new token and write it to the session.

#### `matches(): bool`

Compare session and request token.

#### `getToken(): string`

Get the runtime token

### Field

#### `generate(): string` 

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email mail@pascalebeier.de instead of using the issue tracker.

## Credits

- [Pascale Beier][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/PascaleBeier/CSRF.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/PascaleBeier/CSRF.svg?style=flat-square
[ico-psr2]: https://img.shields.io/badge/psr-2-brightgreen.svg
[ico-psr4]: https://img.shields.io/badge/psr-4-brightgreen.svg

[link-packagist]: https://packagist.org/packages/PascaleBeier/CSRF
[link-downloads]: https://packagist.org/packages/PascaleBeier/CSRF
[link-author]: https://github.com/PascaleBeier
[link-contributors]: ../../contributors
