<?php

namespace tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Vaggelis\LaravelCasService\Cas\CasRedirectData;

class CasRedirectDataTest extends TestCase
{
    /** @test */
    public function it_gets_all_parameters()
    {
        $data = new CasRedirectData();

        $this->assertEmpty($data->getAllParameters());

        $data->setParameter('gateway', true);

        $this->assertEquals(true, $data->getAllParameters()['gateway']);
    }

    /** @test */
    public function it_gets_cache_status()
    {
        $data = new CasRedirectData();

        $this->assertFalse($data->getIsCacheable());
    }

    /** @test */
    public function it_sets_cache_status()
    {
        $data = new CasRedirectData();
        $data->setIsCacheable(true);
        $this->assertTrue($data->getIsCacheable());
    }

    /** @test */
    public function it_sets_services_parameters()
    {
        $data = new CasRedirectData();
        $data->setServiceParameter('returnto', '/test');
        $this->assertEquals($data->getServiceParameter('returnto'),'/test');
    }

    /** @test */
    public function it_returns_all_service_parameters()
    {
        $data = new CasRedirectData();
        $this->assertEquals([],$data->getAllServiceParameters());

        $data->setServiceParameter('returnto', '/test');
        $this->assertEquals(['returnto' => '/test'], $data->getAllServiceParameters());

        $data = new CasRedirectData(['returnto' => '/test']);
        $this->assertEquals(['returnto' => '/test'], $data->getAllServiceParameters());
    }
}
