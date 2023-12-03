#!/usr/bin/env bash
printf "\nRun PHPMD\n"
# disabled for now @see: https://github.com/pdepend/pdepend/issues/695
#./vendor/bin/phpmd src/ text phpmd-ruleset.xml

printf "\nRun PHPStan\n"
composer analyse
