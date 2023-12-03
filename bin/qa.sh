#!/usr/bin/env bash
printf "\nRun PHPMD\n"
./vendor/bin/phpmd src/ text phpmd-ruleset.xml

printf "\nRun PHPStan\n"
composer analyse
