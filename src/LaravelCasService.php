<?php

namespace Vaggelis\LaravelCasService;

use Vaggelis\LaravelCasService\Contracts\ICasInstance;

class LaravelCasService
{
    private $_casInstance;

    public function __construct(ICasInstance $casInstance)
    {
        $this->_casInstance = $casInstance;
    }

    public function login()
    {
        $this->_casInstance->login();
    }
}
