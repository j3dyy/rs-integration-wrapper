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

    public static function from(ResponseInterface $response, string $type = 'json'): RSResponse
    {
        $data = null;
        switch ($type) {
            case 'json':
                $data = json_decode($response->getBody()->getContents(), true);
                break;
            case 'wayBill':
                $r = strtr($response->getBody()->getContents(), ['</soap:' => '</', '<soap:' => '<']);
                $data = (array)json_decode(json_encode(simplexml_load_string($r)));
                break;
        }


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