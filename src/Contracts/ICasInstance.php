<?php

namespace Vaggelis\LaravelCasService\Contracts;


use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

interface ICasInstance
{
    public function login(Request $request) : RedirectResponse;
}
