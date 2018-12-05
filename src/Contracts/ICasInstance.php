<?php

namespace Vaggelis\LaravelCasService\Contracts;


use Illuminate\Http\Request;

interface ICasInstance
{
    public function login(Request $request);
}
