#!/usr/bin/env bash
printf "\nRun PHPMD\n"
./vendor/bin/phpmd src/ text phpmd-ruleset.xml

printf "\nRun PHPStan\n"
composer analyse

printf "\nRun Rector\n"
./vendor/bin/rector process
