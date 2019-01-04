<?php

namespace tests\Unit;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Vaggelis\LaravelCasService\Cas\CasRedirectData;
use Vaggelis\LaravelCasService\Events\CasPreRedirectEvent;
use Vaggelis\LaravelCasService\Services\CasHelper;
use Vaggelis\LaravelCasService\Services\CasRedirector;

class CasRedirectorTest extends TestCase
{
    /**
     * @var CasRedirector
     */
    private $redirector;

    /**
     * @var CasRedirectData
     */
    private $redirectData;

    protected function setUp()
    {
        parent::setUp();

        $this->redirector  = new CasRedirector(new CasHelper);
        $this->redirectData = new CasRedirectData;
    }

    /** @test */
    public function it_returns_target_url()
    {
        $response = $this->redirector->buildRedirectResponse($this->redirectData, TRUE);
        $url = config('laravelcasservice.server.protocol') .
            '://' .
            config('laravelcasservice.server.hostname') .
            '/cas/login?service=' .
            config('app.url');

        $this->assertEquals($url, urldecode($response->getTargetUrl()));
    }

    /** @test */
    public function it_handles_redirection_control()
    {
        $this->redirectData->preventRedirection();
        $response = $this->redirector->buildRedirectResponse($this->redirectData);
        $this->assertNull($response);

        $this->redirectData->forceRedirection();
        $response = $this->redirector->buildRedirectResponse($this->redirectData);
        $this->assertNotNull($response);
    }

    /** @test */
    public function it_returns_a_redirect_response()
    {
        $response = $this->redirector->buildRedirectResponse($this->redirectData);

        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

    /** @test */
    public function it_dispatches_pre_redirect_event()
    {
        Event::fake();

        $this->redirector->buildRedirectResponse($this->redirectData);

        Event::assertDispatched(CasPreRedirectEvent::class);
    }
}
