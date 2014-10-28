![Travis build status](https://travis-ci.org/yitznewton/procslyte.svg?branch=master)

# ProCSLyte: a PHP processor for Citation Style Language (CSL)

This library is a processor for CSL. See
[the specification](http://citationstyles.org/downloads/specification.html#text).

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

