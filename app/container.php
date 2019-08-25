<?php

use function DI\get;
use Slim\Views\Twig;
use Cart\Model\Product;
use Interop\Container\ContainerInterface;
use Slim\Views\TwigExtension;


return [
    'router' => get(Slim\Router::class),
    Twig::class => function (ContainerInterface $c) {
        $twig = new Twig(__DIR__ . '/../resources/views', [
           'cache' => false 
        ]);
        $twig->addExtension(new TwigExtension(
                $c->get('router'),
                $c->get('request')->getUri()
        ));
        
        return $twig;
    },
    Product::class => function(ContainderInterface $c) {
        return new Product;
    }  
];