ifeq ($(TRAVIS_PHP_VERSION),hhvm)
# HHVM doesn't work with phpmd
ci: composer-validate phpcs php-cs-fixer phpunit
else
ci: composer-validate phpcs phpmd php-cs-fixer phpunit
endif

composer-validate:
	composer validate

phpcs:
	./vendor/bin/phpcs --standard=psr2 ./src
	./vendor/bin/phpcs --standard=psr2 ./tests


phpmd:
	./vendor/bin/phpmd tests/ text codesize,controversial,design,naming,unusedcode
	./vendor/bin/phpmd src/ text codesize,controversial,design,naming,unusedcode

php-cs-fixer:
	./vendor/bin/php-cs-fixer --dry-run --verbose fix src --fixers=unused_use
	./vendor/bin/php-cs-fixer --dry-run --verbose fix tests --fixers=unused_use

phpunit:
	./vendor/bin/phpunit
