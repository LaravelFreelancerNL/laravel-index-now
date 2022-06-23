#!/usr/bin/env bash
printf "\nRun PHPMD\n"
./vendor/bin/phpmd src/ text phpmd-ruleset.xml

printf "\nRun PHPCPD\n"
./vendor/bin/phpcpd src

printf "\nRun PHPStan\n"
composer analyse
