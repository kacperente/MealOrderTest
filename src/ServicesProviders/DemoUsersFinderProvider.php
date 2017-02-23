<?php

namespace Eden\MealOrder\ServicesProviders;

use Silex\Provider\MonologServiceProvider;
use Pimple\ServiceProviderInterface;
use Pimple\Container;

class DemoUsersFinderProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     */
    public function register(Container $app)
    {
        $app['service.demo_users_finder'] = function(Container $app) {
            return new DemoUsersFinder($app['orm.em']->getConnection());
        };
    }
}