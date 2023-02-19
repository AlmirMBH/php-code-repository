<?php

/**
 * PSR - PHP Standard Recommendation (php-fig.org)
 * There are 18 PSR standards. While some standards like 5 and 19 are still drafts, other standards like
 * 8, 9 and 10 are abandoned. Standards 0 and 2 are deprecated.
 * For example, PSR12 is called Extended Coding Style. The use of PSR is in line with RFC2119.
 * IDEs like PHPStorm allow you to select the PSR standard and then the code formating can be done automatically.
 * 
 * 
 * Autoloader works based on checking which class is required by key word 'use'.
 * With a little bit of modification any file can be included.
 * __DIR__ returns the root directory to the current file e.g. C:\xampp\htdocs\php-code-repository\psr4
 * 
 * Composer is a dependency manager for PHP.
 * After the installation of the composer, require any package e.g. 'composer require ramsey/uuid' and
 * vendor directory, composer.json and composer.lock files will be created in the root of the project.
 * Another way to generate composer.json is to run a command 'composer init'.
 * 
 * In a nutshell, composer is a configuration file where all the dependencies are.
 * Composer lock file is a file that locks composer dependencies to a fixed state. It contains
 * all the packages and dependecies that the project depends on.
 * 
 * The package source code is located in the vendor dirctory. For example, if UUID package is used it will be
 * located in the vendor directory. This package has its own composer.json and composer.lock and it can
 * depend on other packages.
 * 
 * The composer.json has require and require-dev. As their name suggest, they require dependencies for
 * development and production. The dependencies included in the dev will not be installed if our package is
 * installed as dependency of another project.
 * 
 * Another important file in the vendor is the autoload.php. This is the file that autoloads all of the classes
 * of dependencies.
 */

spl_autoload_register(function($class){
    $path = __DIR__ . "\\" . str_replace('\\', '/', $class) . '.php';
    if(file_exists($path)){
        echo $path, "<br>";
        require $path;
    }
});

// autoloader only for vendor directory, if psr4 not specified in composer.json
require __DIR__ . '/../vendor/autoload.php';
$uuid = new \Ramsey\Uuid\UuidFactory();
echo "<br>", $uuid->uuid4(), "<br>";

use Klarna\Transaction;
use Stripe\Transaction as StripeTransaction;

$klarnaTransaction = new Transaction();
$stripeTransaction = new StripeTransaction();
var_dump($klarnaTransaction);
echo "<br>";
var_dump($stripeTransaction);





