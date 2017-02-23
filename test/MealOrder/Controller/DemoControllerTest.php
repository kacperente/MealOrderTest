<?php

namespace Eden\MealOrder\Tests\Controller;

class DemoControllerTest extends \Eden\MealOrder\Tests\AbstractTest
{

    /**
     * @test
     */
    public function getSomething_shouldReturnStatusOk()
    {
        $client = $this->createClient();


        $client->request('GET', '/demo/someValue');
        $response = $client->getResponse();

        // first attempt should be successful
        $this->assertEquals(200, $response->getStatusCode());

        $responseContent = json_decode($response->getContent(), true);
        $this->assertEquals('OK', $responseContent['code']);
        $this->assertEquals(['is this what you wanted?' => 'someValue'], $responseContent['data']);
    }

    /**
     * @test
     */
    public function createSomething_shouldReturnStatusOk()
    {
        $client = $this->createClient();

        $dataToSend = ['testKey' => 'testValue'];
        $dataJson = json_encode($dataToSend);

        $client->request('POST', '/demo',[], [], ['CONTENT_TYPE' => 'application/json'], $dataJson);
        $response = $client->getResponse();

        // first attempt should be successful
        $this->assertEquals(200, $response->getStatusCode());

        $responseContent = json_decode($response->getContent(), true);
        $this->assertEquals('OK', $responseContent['code']);

        $this->assertEquals($dataToSend, $responseContent['data']);
    }
}