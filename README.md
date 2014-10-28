![Travis build status](http://img.shields.io/travis/yitznewton/procslyte.svg)
![PHP 5.3 not supported](http://img.shields.io/badge/5.3-not_supported-red.svg)
![PHP 5.4 supported](http://img.shields.io/badge/5.4-supported-orange.svg)
![PHP 5.5 recommended](http://img.shields.io/badge/5.5-recommended-green.svg)
![PHP 5.6 recommended](http://img.shields.io/badge/5.6-recommended-green.svg)
![HHVM not tested](http://img.shields.io/hhvm/yitznewton/procslyte.svg)
![BSD 2-Clause license](http://img.shields.io/packagist/l/yitznewton/procslyte.svg)

# ProCSLyte
## A PHP processor for Citation Style Language (CSL)

This library is a processor for CSL. See
[the specification](http://citationstyles.org/downloads/specification.html#text).

ProCSLyte is in very early development; it is not yet usable to generate
citations.

## Installation

To install ProCSLyte in your app:

```shell
$ composer require yitznewton/procslyte
```

To work on the ProCSLyte code:

```shell
$ composer install
```

## Tests

```shell
$ make phpunit
# or
$ ./vendor/bin/phpunit
```

To run the full CI harness:

```shell
$ make ci
```

## License

[BSD 2-Clause](http://opensource.org/licenses/BSD-2-Clause)

