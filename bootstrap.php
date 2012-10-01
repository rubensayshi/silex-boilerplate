<?php

$loader = require __DIR__ . '/autoload.php';

/**
 * @return \Igorw\Silex\Env
 */
function getAppEnv() {
    static $env = null;

    if (is_null($env)) {
        $env = new Igorw\Silex\Env(__DIR__ . '/config/cnf');
    }

    return $env;
}

/**
 * @return \Igorw\Silex\Config
 */
function getAppConfig($key = null) {
    static $cnf = null;

    if (is_null($cnf)) {
        $cnf = new Igorw\Silex\Config(getAppEnv());
    }

    if (!is_null($key)) {
        return $cnf->getConfig($key);
    }

    return $cnf;
}

// Include the main Propel script
require_once __DIR__ . '/vendor/propel/runtime/lib/Propel.php';

// Initialize Propel with the runtime configuration
$propelcnf = (array)getAppConfig('propel');
$propelcnf['classmap'] = include(__DIR__ . '/config/classmap-gw2spidy-conf.php');
Propel::setConfiguration($propelcnf);
Propel::initialize();

// initiate the application, check config to enable debug / sql logging when needed
$app = new Silex\Application();

// register config provider
$app->register(new Igorw\Silex\ConfigServiceProvider(getAppConfig()));
$app->register(new TMG\Services\ServicesProvider());
$app->register(new Rafal\MemcacheServiceProvider\MemcacheServiceProvider());

// setup dev mode related stuff based on config
isset($app['sql_logging']) && $app['sql_logging'] && $app->enableSQLLogging();

// register providers
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
