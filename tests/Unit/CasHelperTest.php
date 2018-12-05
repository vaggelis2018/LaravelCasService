<?php

namespace tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Vaggelis\LaravelCasService\Service\CasHelper;

class CasHelperTest extends TestCase
{
    /** @test */
    public function it_returns_the_server_base_url()
    {
        $casHelper = new CasHelper();

        $this->assertEquals('https://cas.example.apps/cas/', $casHelper->getServerBaseUrl());
    }
}
