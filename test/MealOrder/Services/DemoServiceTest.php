<?php

namespace Eden\MealOrder\Services\Controller;

use Eden\Intern\Services\DemoService;
use Psr\Log\NullLogger;

class DemoServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function doSth_ShouldReturnValueFromInput()
    {
        $service = new DemoService(new NullLogger());
        $result = $service->doSth('someValue');
        $this->assertEquals('someValue', $result);
    }
}