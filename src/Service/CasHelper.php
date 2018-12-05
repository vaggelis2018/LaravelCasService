<?php

namespace Vaggelis\LaravelCasService\Service;

use Illuminate\Support\Facades\Config;

/**
 * Class CasHelper.
 */
class CasHelper
{
    /**
     * SSL configuration to use the system's CA bundle to verify CAS server.
     *
     * @var int
     */
    const CA_DEFAULT = 0;

    /**
     * SSL configuration to use provided file to verify CAS server.
     *
     * @var int
     */
    const CA_CUSTOM = 1;

    /**
     * SSL Configuration to not verify CAS server.
     *
     * @var int
     */
    const CA_NONE = 2;

    /**
     * Gateway config: never check preemptively to see if the user is logged in.
     *
     * @var int
     */
    const CHECK_NEVER = -2;

    /**
     * Gateway config: check once per session to see if the user is logged in.
     *
     * @var int
     */
    const CHECK_ONCE = -1;

    /**
     * Gateway config: check on every page load to see if the user is logged in.
     *
     * @var int
     */
    const CHECK_ALWAYS = 0;

    /**
     * Event type identifier for the CasPreUserLoadEvent.
     *
     * @var string
     */
    const EVENT_PRE_USER_LOAD = 'cas.pre_user_load';

    /**
     * Event type identifier for the CasPreRegisterEvent.
     *
     * @var string
     */
    const EVENT_PRE_REGISTER = 'cas.pre_register';

    /**
     * Event type identifier for the CasPreLoginEvent.
     *
     * @var string
     */
    const EVENT_PRE_LOGIN = 'cas.pre_login';

    /**
     * Event type identifier for pre validation events.
     *
     * @var string
     */
    const EVENT_PRE_VALIDATE = 'cas.pre_validate';

    /**
     * Event type identifier for events fired after service validation.
     *
     * @var string
     */
    const EVENT_POST_VALIDATE = 'cas.post_validate';

    /**
     * Event type identifier for events fired after login has completed.
     */
    const EVENT_POST_LOGIN = 'cas.post_login';

    /**
     * Stores logger.
     *
     * @var \Drupal\Core\Logger\LoggerChannel
     */
    protected $loggerChannel;

    /**
     * Construct the base URL to the CAS server.
     *
     * @return string
     *   The base URL.
     */
    public function getServerBaseUrl() {
        $protocol = Config::get('laravelcasservice.server.protocol');
        $url = $protocol . '://' . Config::get('laravelcasservice.server.hostname');

        // Only append port if it's non standard.
        $port = Config::get('laravelcasservice.server.port');
        if (($protocol == 'http' && $port != 80) || ($protocol == 'https' && $port != 443)) {
            $url .= ':' . $port;
        }

        $url .= Config::get('laravelcasservice.server.path');
        $url = rtrim($url, '/') . '/';

        return $url;
    }

//    /**
//     * Wrap Drupal's normal logger.
//     *
//     * This allows us to only log debug messages if configured to do so.
//     *
//     * @param mixed $level
//     *   The message to log.
//     * @param string $message
//     *   The error message.
//     * @param array $context
//     *   The context.
//     */
//    public function log($level, $message, array $context = []) {
//        // Back out of logging if it's a debug message and we're not configured
//        // to log those types of messages. This helps keep the drupal log clean
//        // on busy sites.
//        if ($level == LogLevel::DEBUG && !$this->settings->get('advanced.debug_log')) {
//            return;
//        }
//        $this->loggerChannel->log($level, $message, $context);
//    }
}
