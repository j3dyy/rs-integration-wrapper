<?php declare(strict_types=1);


use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use J3dyy\RsIntegrationWrapper\Client\Client;
use J3dyy\RsIntegrationWrapper\Exceptions\RSIntegrationException;
use J3dyy\RsIntegrationWrapper\RS;

describe('test authentication', function () {

    $rs = new RS(clientMock());

    it("authentication test", function () use($rs) {
        $response = $rs->authenticate(
           '',
           ''
        );

        expect($response->getStatusCode())
            ->toBe(200)
            ->and($response->getResponse())->toBe(authSuccessMock());

    });

    it("wraps unauthorized request", function () use ($rs) {
        $response = $rs->authenticate(
            '',
            ''
        );
    })->throws(RSIntegrationException::class);

    it("wraps internal response", function () use ($rs) {
        $response = $rs->authenticate(
            '',
            ''
        );
    })->throws(RSIntegrationException::class);
});


function authSuccessMock(): array
{
    return [
        "DATA" => [
            "ACCESS_TOKEN" => "fafo",
            "EXPIRES_IN" => 2400,
            "MASKED_MOBILE" => "",
        ],
        "STATUS"=>[
            "ID"=>0,
            "TEXT" => 'წარმატებით დასრულდა'
        ]
    ];
}


function clientMock():Client
{
    $mock = new MockHandler([
        new Response(200, ['X-Foo' => 'Bar'], json_encode(authSuccessMock())),
        new Response(401, ['X-Foo' => 'Bar'], json_encode(authSuccessMock())),
        new Response(500, ['X-Foo' => 'Bar']),
    ]);

    return new Client($mock);
}