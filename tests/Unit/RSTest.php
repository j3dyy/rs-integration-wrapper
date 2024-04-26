<?php declare(strict_types=1);


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

describe('test authentication', function () {

    beforeEach(function () {

        $client = new \J3dyy\RsIntegrationWrapper\Client\Client();

        $this->rs = new \J3dyy\RsIntegrationWrapper\RS($client);
        $this->username = '426517753';
        $this->password = '426517753E1';
    });

    it("authentication test",function (){

//        $mock = new MockHandler([
//            new Response(200, ['X-Foo' => 'Bar'], 'Hello, World'),
//            new Response(202, ['Content-Length' => 0]),
//            new RequestException('Error Communicating with Server', new Request('GET', 'test'))
//        ]);
//        $handlerStack = HandlerStack::create($mock);
//        $client = new Client(['handler' => $handlerStack]);


        $response = $this->rs->authenticate(
            $this->username,
            $this->password
        );



        expect($response->getStatusCode())->toBe(200);
        expect(true)->toBeTrue();
    });
});


