![Travis build status](http://img.shields.io/travis/yitznewton/procslyte.svg)
![Code Climate grade](http://img.shields.io/codeclimate/github/yitznewton/procslyte.svg)
![Code Climate coverage](http://img.shields.io/codeclimate/coverage/github/yitznewton/procslyte.svg)
![PHP 5.3 not supported](http://img.shields.io/badge/5.3-not_supported-red.svg)
![PHP 5.4 supported](http://img.shields.io/badge/5.4-supported-green.svg)
![PHP 5.5 supported](http://img.shields.io/badge/5.5-supported-green.svg)
![PHP 5.6 supported](http://img.shields.io/badge/5.6-supported-green.svg)
![HHVM not tested](http://img.shields.io/hhvm/yitznewton/procslyte.svg)
![license: GPL](http://img.shields.io/packagist/l/yitznewton/procslyte.svg)

# ProCSLyte
## A PHP processor for Citation Style Language (CSL)

ProCSLyte (pronounced "proselyte") is a processor for CSL. See
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

[GPLv3](http://opensource.org/licenses/GPL-3.0)
