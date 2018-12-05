<?php

namespace tests\Unit;

use Illuminate\Support\Facades\Config;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Vaggelis\LaravelCasService\Cas\CasInstance;

class CasInstanceTest extends TestCase
{
    /** @test */
    public function it_redirects_cas()
    {
        dd(Config::get('laravelcasservice'));
//        $casInstance = new CasInstance();
//        $casInstance->login();
//        $response = $casInstance->login();
//
//        $this->get()
//
//        $response->assertRedirect()
    }
}
