<?php
/**
 * PageRequestInterface.php
 *
 * PHP version 7.2
 *
 * @category Interface
 * @package  Mjorgens\Crawler\PageRequest
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/mjorgens/web-crawler
 */

namespace Mjorgens\Crawler\PageRequest;

use GuzzleHttp\Client;
use Mjorgens\Crawler\Model\WebPage;
use Psr\Http\Message\UriInterface;

/**
 * Interface PageRequestInterface
 *
 * @category Interface
 * @package  Mjorgens\Crawler\PageRequest
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/mjorgens/web-crawler
 */
interface PageRequestInterface
{
    /**
     * Static method that requests an url and returns a
     * WebPage of the response. If an error occurs
     * it returns null.
     *
     * @param Client       $client Guzzle client
     * @param UriInterface $url    Url to get
     *
     * @return WebPage|null
     */
    public static function getPage(Client $client, UriInterface $url): ?WebPage;
}
