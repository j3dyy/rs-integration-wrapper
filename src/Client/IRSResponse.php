<?php

namespace J3dyy\RsIntegrationWrapper\Client;

interface IRSResponse
{

    public function get(string $key): mixed;
    public function getResponse(): array;

    public function getStatusCode(): int;

    public function getHeaders(): array;
}