#!/usr/bin/env bash

#clear && \
#echo "remove phpunit/phpunit" && \
#/f/OSPanel/modules/php/PHP-7.2-x64/php.exe ~/bin/composer.phar remove phpunit/phpunit --no-interaction --dev -q && \
#echo "require phpunit/phpunit" && \
#/f/OSPanel/modules/php/PHP-5.3/php.exe ~/bin/composer.phar require phpunit/phpunit:^4 --no-interaction --dev -q && \
/f/OSPanel/modules/php/PHP-5.3/php.exe ~/bin/phpunit-4.8.36.phar -v && \
/f/OSPanel/modules/php/PHP-5.4/php.exe ~/bin/phpunit-4.8.36.phar -v && \
/f/OSPanel/modules/php/PHP-5.5/php.exe ~/bin/phpunit-4.8.36.phar -v && \
/f/OSPanel/modules/php/PHP-5.5-x64/php.exe ~/bin/phpunit-4.8.36.phar -v && \
#echo "remove phpunit/phpunit" && \
#/f/OSPanel/modules/php/PHP-7.2-x64/php.exe ~/bin/composer.phar remove phpunit/phpunit --no-interaction --dev -q && \
#echo "require phpunit/phpunit" && \
#/f/OSPanel/modules/php/PHP-7.2-x64/php.exe ~/bin/composer.phar require "phpunit/phpunit:^5.7" --no-interaction --prefer-source --dev -q && \
/f/OSPanel/modules/php/PHP-5.6/php.exe ~/bin/phpunit-5.7.27.phar -v && \
/f/OSPanel/modules/php/PHP-5.6-x64/php.exe ~/bin/phpunit-5.7.27.phar -v && \
/f/OSPanel/modules/php/PHP-7.0/php.exe ~/bin/phpunit-6.5.13.phar -v && \
/f/OSPanel/modules/php/PHP-7.0-x64/php.exe ~/bin/phpunit-6.5.13.phar -v && \
/f/OSPanel/modules/php/PHP-7.1/php.exe ~/bin/phpunit-7.4.0.phar -v && \
/f/OSPanel/modules/php/PHP-7.1-x64/php.exe ~/bin/phpunit-7.4.0.phar -v && \
/f/OSPanel/modules/php/PHP-7.2/php.exe ~/bin/phpunit-7.4.0.phar -v && \
/f/OSPanel/modules/php/PHP-7.2-x64/php.exe ~/bin/phpunit-7.4.0.phar -v
