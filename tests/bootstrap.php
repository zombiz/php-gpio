<?php

$rpi = 'raspberrypi';
if ($rpi !== $nodename = exec('uname --nodename')) {
    $warning = sprintf("Precondition is not met : %s is not a %s machine! ", $nodename, $rpi);
    echo <<<EOT

$warning


EOT;
}


if (!extension_loaded('curl') || !function_exists('curl_init')) {
    die(<<<EOT
cURL has to be enabled!
EOT
);
}

if (!($loader = @include __DIR__ . '/../vendor/autoload.php')) {
    die(<<<EOT
You need to install the project dependencies using Composer:
$ wget http://getcomposer.org/composer.phar
OR
$ curl -s https://getcomposer.org/installer | php
$ php composer.phar install --dev
$ phpunit

EOT
);
}

$loader->add('PhpGpio\Tests', __DIR__);
