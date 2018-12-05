<?php

namespace Vaggelis\LaravelCasService\Service;

use Illuminate\Support\Facades\Event;
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
    protected $casHelper;

    /**
     * CasRedirector constructor.
     *
     * @param CasHelper $casHelper
     * The CasHelper service.
     */
    public function __construct(CasHelper $casHelper)
    {
        $this->casHelper = $casHelper;
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
     * @return \Drupal\Core\Routing\TrustedRedirectResponse|\Drupal\cas\CasRedirectResponse|null
     *   The RedirectResponse or NULL if a redirect shouldn't be done.
     */
    public function buildRedirectResponse(CasRedirectData $data, $force = FALSE)
    {
        $response = NULL;

        // Generate login url.
        $loginUrl = $this->casHelper->getServerBaseUrl() . 'login';

        // Dispatch an event that allows modules to alter or prevent the redirect.
        $preRedirectEvent = new CasPreRedirectEvent($data);
        Event::dispatch($preRedirectEvent);

        // Determine the service URL.
        $serviceParameters = $data->getAllServiceParameters();
        $parameters = $data->getAllParameters();
//        $parameters['service'] = $this->urlGenerator->generate('cas.service', $service_parameters, UrlGeneratorInterface::ABSOLUTE_URL);
//
//        $login_url .= '?' . UrlHelper::buildQuery($parameters);
//
//        // Get the redirection response.
//        if ($force || $data->willRedirect()) {
//            // $force implies we are on the /cas url or equivalent, so we
//            // always want to redirect and data is always cacheable.
//            if (!$force && !$data->getIsCacheable()) {
//                return new CasRedirectResponse($login_url);
//            }
//            else {
//                $cacheable_metadata = new CacheableMetadata();
//                // Add caching metadata from CasRedirectData.
//                if (!empty($data->getCacheTags())) {
//                    $cacheable_metadata->addCacheTags($data->getCacheTags());
//                }
//                if (!empty($data->getCacheContexts())) {
//                    $cacheable_metadata->addCacheContexts($data->getCacheContexts());
//                }
//                $response = new TrustedRedirectResponse($login_url);
//                $response->addCacheableDependency($cacheable_metadata);
//            }
//            $this->casHelper->log(LogLevel::DEBUG, "Cas redirecting to %url", array('%url' => $login_url));
//        }
//        return $response;
    }
}
