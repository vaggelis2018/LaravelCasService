<?php

namespace Vaggelis\LaravelCasService;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Vaggelis\LaravelCasService\Contracts\ICasInstance;
use Vaggelis\LaravelCasService\Contracts\ILaravelCasService;

class LaravelCasService implements ILaravelCasService
{
    private $_casInstance;

    public function __construct(ICasInstance $casInstance)
    {
        $this->_casInstance = $casInstance;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request) : RedirectResponse
    {
        return $this->_casInstance->login($request);
    }
}
