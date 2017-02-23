<?php

namespace Eden\MealOrder\Tests;

class TestListener implements \PHPUnit_Framework_TestListener
{
    /**
    * @param  \PHPUnit_Framework_Test $test
    * @param  float $time
    */
    public function endTest(\PHPUnit_Framework_Test $test, $time)
    {
        /**
        * Close doctrine connections to avoid having a 'too many connections'
        * message when running many tests
        */
        if ($test instanceof AbstractTest) {
            $app = $test->getApp();
            $app['orm.em']->getConnection()->close();
        }
    }


    public function startTestSuite(\PHPUnit_Framework_TestSuite $suite)
    {
    }

    public function addError(\PHPUnit_Framework_Test $test, \Exception $e, $time)
    {
    }

    public function addFailure(\PHPUnit_Framework_Test $test, \PHPUnit_Framework_AssertionFailedError $e, $time)
    {
    }

    public function addIncompleteTest(\PHPUnit_Framework_Test $test, \Exception $e, $time)
    {
    }

    public function addSkippedTest(\PHPUnit_Framework_Test $test, \Exception $e, $time)
    {
    }

    public function addRiskyTest(\PHPUnit_Framework_Test $test, \Exception $e, $time)
    {
    }


    public function endTestSuite(\PHPUnit_Framework_TestSuite $suite)
    {
    }

    public function startTest(\PHPUnit_Framework_Test $test)
    {
    }
}
