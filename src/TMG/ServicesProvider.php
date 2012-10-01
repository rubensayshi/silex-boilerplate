<?php

namespace TMG;

use Silex\Application;
use Silex\ServiceProviderInterface;

class ServicesProvider implements ServiceProviderInterface {
    public function register(Application $app) {
        /*
        $app['example_service'] = $app->share(function() use ($app) {
            return new ExampleService($app);
        });
        */
    }

    public function boot(Application $app) {}
}

?>
