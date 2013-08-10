rm composer.lock
rm composer.phar
rm -rf vendor
rm -rf bin
curl -sS https://getcomposer.org/installer | php
./composer.phar install