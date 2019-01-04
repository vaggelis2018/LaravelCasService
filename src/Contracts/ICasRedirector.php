<?php

namespace Vaggelis\LaravelCasService\Contracts;


use Illuminate\Http\RedirectResponse;
use Vaggelis\LaravelCasService\Cas\CasRedirectData;

interface ICasRedirector
{
    public function buildRedirectResponse(CasRedirectData $casRedirectData, $force = FALSE) : ?RedirectResponse;
}
