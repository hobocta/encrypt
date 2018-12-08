#!/usr/bin/env bash
/f/OSPanel/modules/php/PHP-5.6-x64/php.exe ~/bin/phpunit-5.7.27.phar --coverage-html=tests/coverage
/f/OSPanel/modules/php/PHP-5.6-x64/php.exe ~/bin/phpunit-5.7.27.phar --coverage-clover=tests/coverage/clover.xml
source tests/manual/env.sh
bash <(curl -s https://codecov.io/bash)
