<?php

/**
 * using Silex micro framework
 *  this file contains all routing and the 'controllers' using lambda functions
 */

use TMG\Twig\VersionedAssetsRoutingExtension;
use TMG\Twig\GenericHelpersExtension;

$app = require __DIR__ . '/../bootstrap.php';

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'    => __DIR__ . '/../templates',
    'twig.options' => array(
        'cache' => __DIR__ . '/../tmp/twig-cache',
    ),
));

// register custom twig extensions
$app['twig']->addExtension(new GenericHelpersExtension());
$app['twig']->addExtension(new VersionedAssetsRoutingExtension($app));

/**
 * ----------------------
 *  route /
 * ----------------------
 */
$app->get("/", function(Request $request) use($app) {
    return $app['twig']->render('home.html.twig');
});

// handle request
$app->run();
