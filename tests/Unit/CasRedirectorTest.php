<?php

namespace tests\Unit;

use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Vaggelis\LaravelCasService\Cas\CasRedirectData;
use Vaggelis\LaravelCasService\Events\CasPreRedirectEvent;
use Vaggelis\LaravelCasService\Service\CasHelper;
use Vaggelis\LaravelCasService\Service\CasRedirector;

class CasRedirectorTest extends TestCase
{
    /** @test */
    public function it_dispatches_pre_redirect_event()
    {
        Event::fake();

        $redirector = new CasRedirector(new CasHelper());

        $data = new CasRedirectData();

        $redirector->buildRedirectResponse($data);

        Event::assertDispatched(CasPreRedirectEvent::class);
    }
}
