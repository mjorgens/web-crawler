<?php
/**
 * LinkParser.php
 *
 * PHP version 7.2
 *
 * @category Helper
 * @package  Mjorgens\Crawler\LinkParser
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/mjorgens/web-crawler
 */

namespace Mjorgens\Crawler\LinkParser;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class LinkParser
 *
 * Helper class to parse a string of html and return the links within it.
 *
 * @category Helper
 * @package  Mjorgens\Crawler\LinkParser
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/mjorgens/web-crawler
 */
class LinkParser implements LinkParserInterface
{
    /**
     * Static method that takes in a string of html and returns an array of links
     *
     * @param string       $html       The html to parse
     * @param UriInterface $foundOnUrl The base url were it was found
     *
     * @return array
     */
    public static function parseLinks(string $html, UriInterface $foundOnUrl): array
    {
        $crawler = new Crawler($html, $foundOnUrl);
        $links = [];

        // iterate though all of the links and add to an array
        foreach ($crawler->filterXpath('//a')->links() as $link) {
            $links[] = new Uri($link->getUri());
        }

        return $links;
    }
}
