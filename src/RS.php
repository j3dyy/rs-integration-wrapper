<?php
namespace J3dyy\RsIntegrationWrapper;

use J3dyy\RsIntegrationWrapper\client\Client;

class RS
{
    protected Client  $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function authenticate()
    {
        
    }
}