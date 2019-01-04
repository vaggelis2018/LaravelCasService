<?php

namespace tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Vaggelis\LaravelCasService\Cas\CasRedirectData;

class CasRedirectDataTest extends TestCase
{
    /** @test */
    public function it_sets_and_gets_a_single_parameter()
    {
        $data = new CasRedirectData;
        $data->setParameter('service', 'test');

        $this->assertEquals($data->getParameter('service'), 'test');
    }

    /** @test */
    public function it_gets_all_parameters()
    {
        $data = new CasRedirectData();

        $this->assertEmpty($data->getAllParameters());

        $data->setParameter('gateway', true);

        $this->assertEquals(true, $data->getAllParameters()['gateway']);
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
    /** @test */
    public function it_checks_if_it_will_redirect()
    {
        $data = new CasRedirectData();
        $this->assertTrue($data->willRedirect());
    }

    /** @test */
    public function it_sets_force_redirect_to_true()
    {
        $data = new CasRedirectData();
        $data->forceRedirection();

        $this->assertTrue($data->willRedirect());
    }

    /** @test */
    public function it_sets_prevent_redirect_to_false()
    {
        $data = new CasRedirectData();
        $data->preventRedirection();

        $this->assertFalse($data->willRedirect());
    }
}
