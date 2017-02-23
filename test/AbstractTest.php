<?php

namespace Eden\MealOrder\Tests;

use Doctrine\ORM\EntityManager;
use Silex\Application;
use Silex\WebTestCase;

abstract class AbstractTest extends WebTestCase {
    /** @var EntityManager */
    protected $em;
    /** @var Application */
    protected $app;

    public function getApp()
    {
        return $this->app;
    }

    public function setUp()
        {
            parent::setUp();

            $this->em = $this->app['orm.em'];
        }

    public function createApplication()
    {
        /** @var Application $app */
        $app = require __DIR__.'/../app/app.php';
        $app['debug'] = true;
        $app->boot();
        unset($app['exception_handler']);
        return $app;
    }
}
