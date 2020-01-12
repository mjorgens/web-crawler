<?php
/**
 * LinkParserInterface.php
 *
 * PHP version 7.2
 *
 * @category Interface
 * @package  Mjorgens\Crawler\LinkParser
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/mjorgens/web-crawler
 */

namespace Mjorgens\Crawler\LinkParser;

use Psr\Http\Message\UriInterface;

/**
 * Interface LinkParserInterface
 *
 * @category Interface
 * @package  Mjorgens\Crawler\LinkParser
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/mjorgens/web-crawler
 */
interface LinkParserInterface
{
    /**
     * Static method that takes in a string of html and returns an array of links
     *
     * @param string       $html       The html to parse
     * @param UriInterface $foundOnUrl The base url were it was found
     *
     * @return array
     */
    public static function parseLinks(string $html, UriInterface $foundOnUrl): array;
}
