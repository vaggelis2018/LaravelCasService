<?php

namespace Vaggelis\LaravelCasService\Cas;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Vaggelis\LaravelCasService\Contracts\ICasInstance;
use Vaggelis\LaravelCasService\Contracts\ICasRedirector;

class CasInstance implements ICasInstance
{
    private $casRedirector;

    public function __construct(ICasRedirector $casRedirector)
    {
        $this->casRedirector = $casRedirector;
    }

    public function login(Request $request) : RedirectResponse
    {
        $serviceUrlParams = $request->query();
        $casRedirectData = new CasRedirectData($serviceUrlParams);
        return $this->casRedirector->buildRedirectResponse($casRedirectData, TRUE);
    }
}
