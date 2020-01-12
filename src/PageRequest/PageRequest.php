<?php
/**
 * PageRequest.php
 *
 * PHP version 7.2
 *
 * @category Helper
 * @package  Mjorgens\Crawler\PageRequest
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/mjorgens/web-crawler
 */

namespace Mjorgens\Crawler\PageRequest;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Mjorgens\Crawler\Model\WebPage;
use Psr\Http\Message\UriInterface;

/**
 * Class PageRequest
 *
 * Helper class to retrieve a WebPage from an passed UriInterface
 *
 * @category Helper
 * @package  Mjorgens\Crawler\PageRequest
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/mjorgens/web-crawler
 */
class PageRequest implements PageRequestInterface
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
    public static function getPage(Client $client, UriInterface $url): ?WebPage
    {
        $request = new Request('GET', $url);

        // try and sent the request and if an error return null
        try {
            $response = $client->send($request);
        } catch (RequestException|ConnectException $e) {
            return null;
        }

        $page = new WebPage();
        $page->url = (string)$request->getUri();
        $page->html = (string)$response->getBody();
        return $page;
    }
}
