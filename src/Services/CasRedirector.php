<?php

namespace Vaggelis\LaravelCasService\Services;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Vaggelis\LaravelCasService\Cas\CasRedirectData;
use Vaggelis\LaravelCasService\Contracts\ICasRedirector;
use Vaggelis\LaravelCasService\Events\CasPreRedirectEvent;

class CasRedirector implements ICasRedirector
{
    /**
     * The CasHelper.
     *
     * @var CasHelper
     */
    private $casHelper;

    /**
     * @var UrlGenerator
     */
    private $urlGenerator;

    /**
     * CasRedirector constructor.
     *
     * @param CasHelper $casHelper
     * The CasHelper service.
     */
    public function __construct(CasHelper $casHelper)
    {
        $this->casHelper = $casHelper;
        $this->urlGenerator = App::make(UrlGenerator::class);
    }

    /**
     * CasRedirector constructor.
     *
     * @param CasRedirectData $data
     *   Data used to generate redirector.
     * @param bool $force
     *   True implies that you always want to generate a redirector as occurs with
     *   the ForceRedirectController. False implies redirector is controlled by
     *   the allow_redirect property in the CasRedirectData object.
     *
     * @return RedirectResponse
     *   The RedirectResponse or NULL if a redirect shouldn't be done.
     */
    public function buildRedirectResponse(CasRedirectData $data, $force = FALSE) : ?RedirectResponse
    {
        // Generate login url.
        $loginUrl = $this->casHelper->getServerBaseUrl() . 'login';

        // Dispatch an event that allows modules to alter or prevent the redirect.
        Event::dispatch(new CasPreRedirectEvent($data));

        // Determine the service URL.
        $serviceParameters = $data->getAllServiceParameters();
        $parameters = $data->getAllParameters();

        $parameters['service'] =  $this->urlGenerator->to(Config::get('app.url'), $serviceParameters, true);

        $loginUrl =  "{$loginUrl}?" . http_build_query($parameters, null, '&', PHP_QUERY_RFC3986);

        // Get the redirection response.
        if ($force || $data->willRedirect()) {
            // $force implies we are on the /cas url or equivalent, so we
            // always want to redirect and data is always cacheable.
            $response = (new RedirectResponse($loginUrl));
            Log::debug("Cas redirecting to %url", array('%url' => $loginUrl));

            return $response;
        }

        return null;
    }
}
