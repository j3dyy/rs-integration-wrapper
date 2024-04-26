<?php

namespace J3dyy\RsIntegrationWrapper\Client;

use Psr\Http\Message\ResponseInterface;

interface IClient
{

    function request(string $method, string $endpoint, array $options = []): ResponseInterface;
}