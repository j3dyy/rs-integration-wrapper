<?php declare(strict_types=1);


use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use J3dyy\RsIntegrationWrapper\Client\EApiClient;
use J3dyy\RsIntegrationWrapper\Client\IRSResponse;
use J3dyy\RsIntegrationWrapper\Client\RSResponse;
use J3dyy\RsIntegrationWrapper\Client\WayBill\WayBillClient;
use J3dyy\RsIntegrationWrapper\Exceptions\RSIntegrationException;
use J3dyy\RsIntegrationWrapper\RS;

$rs = new RS(eApiMock(), wayBillMock());

describe('test authentication', function () use ($rs) {
    it("authentication test", function () use ($rs) {
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
        expect($response->getStatusCode())
            ->toBe(401);
    });

    it("wraps internal response", function () use ($rs) {
        $response = $rs->authenticate(
            '',
            ''
        );
        expect($response->getStatusCode())
            ->toBe(500);
    });
});


describe('test user info', function () use ($rs) {
    it('should return user information', function () use ($rs) {
        $ressponse = $rs->userInfo('', '');

        expect($ressponse->getResponse())
            ->toBe(rsInfoSuccessMock())
        ->and($ressponse->getStatusCode())
        ->toBe(200);
    });

    it('should return empty information', function () use ($rs) {
        $ressponse = $rs->userInfo('', '');§
        expect($ressponse->getStatusCode())
            ->toBe(401);
    });
});


function authSuccessMock(): array
{
    return [
        "DATA" => [
            "ACCESS_TOKEN" => "fafo",
            "EXPIRES_IN" => 2400,
            "MASKED_MOBILE" => "",
        ],
        "STATUS" => [
            "ID" => 0,
            "TEXT" => 'წარმატებით დასრულდა'
        ]
    ];
}

function rsInfoSuccessMock(): array
{
    return [
        "DATA" => [
            "Tin" => "000000000",
            "Address" => "xxxxx / xxxx ",
            "IsVatPayer" => false,
            "IsDiplomat" => false,
            "UnID" => 0000000,
            "Name" => "LTD FOO",
        ],
        "STATUS" => [
            "ID" => 0,
            "TEXT" => 'ended'
        ]
    ];
}


function eApiMock(): EApiClient
{
    $mock = new MockHandler([
        new Response(200, ['X-Foo' => 'Bar'], json_encode(authSuccessMock())),
        new Response(401, ['X-Foo' => 'Bar'], json_encode(authSuccessMock())),
        new Response(500, ['X-Foo' => 'Bar']),
        new Response(200, ['X-Foo' => 'Bar'], json_encode(rsInfoSuccessMock())),
        new Response(401, ['X-Foo' => 'Bar'], json_encode(rsInfoSuccessMock())),
    ]);

    return new EApiClient($mock);
}

function wayBillMock(): WayBillClient
{
    $mock = new MockHandler([
        new Response(200, ['X-Foo' => 'Bar']),
    ]);

    return new WayBillClient($mock);
}