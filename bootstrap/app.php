<?php

use Cart\App;
use Slim\Views\Twig;

use Illuminate\Database\Capsule\Manager as Capsule;

session_start();

require __DIR__ . '/../vendor/autoload.php';

$app = new App;

$container = $app->getContainer();

$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'shopping_cart',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();


Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('n9hdn2vf765wcd43');
Braintree_Configuration::publickey('nt9dm6nmc7qqsj6w');
Braintree_Configuration::privateKey('dc1934a52dd8757ea191e9c649e0c90e');
        
        
require __DIR__ . '/../app/routes.php';


$app->add(new \Cart\Middleware\ValidationErrorsMiddleware($container->get(Twig::class)));
$app->add(new \Cart\Middleware\OldInputMiddleware($container->get(Twig::class)));