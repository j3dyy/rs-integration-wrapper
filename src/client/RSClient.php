<?php

namespace J3dyy\RsIntegrationWrapper\client;

interface RSClient
{

    function authenticate(string $username, string $password);
}