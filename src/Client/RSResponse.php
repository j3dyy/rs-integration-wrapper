<?php

namespace J3dyy\RsIntegrationWrapper\Client;

use Psr\Http\Message\ResponseInterface;

class RSResponse implements IRSResponse
{

    public function __construct(
        protected array  $response,
        protected int $statusCode,
        protected array  $headers
    )
    {
    }

    public static function from(ResponseInterface $response): RSResponse
    {
        $data = json_decode($response->getBody()->getContents(), true);

        return new RSResponse(
            $data,
            $response->getStatusCode(),
            $response->getHeaders()
        );
    }

    public function get(string $key): mixed
    {
        return $this->response[$key] ?? null;
    }

    public function getResponse(): array
    {
        return $this->response;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }
}