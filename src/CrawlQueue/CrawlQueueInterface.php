<?php
/**
 * CrawlQueueInterface.php
 *
 * PHP version 7.2
 *
 * @category Interface
 * @package  Mjorgens\Crawler\CrawlQueue
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/mjorgens/web-crawler
 */

namespace Mjorgens\Crawler\CrawlQueue;

use Psr\Http\Message\UriInterface;

/**
 * Interface CrawlQueueInterface
 *
 * @category Interface
 * @package  Mjorgens\Crawler\CrawlQueue
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/mjorgens/web-crawler
 */
interface CrawlQueueInterface
{
    /**
     * Add an UriInterface to the queue
     *
     * @param UriInterface $url The url to add
     *
     * @return void
     */
    public function add(UriInterface $url);

    /**
     * Return the top UriInterface from the queue
     *
     * @return UriInterface
     */
    public function next(): UriInterface;

    /**
     * Check if the queue is empty
     *
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Return the number of items in the queue
     *
     * @return int
     */
    public function numOfUrls(): int;

    /**
     * Check if the UriInterface is already in the queue
     *
     * @param UriInterface $url The url to check
     *
     * @return bool
     */
    public function contains(UriInterface $url): bool;

}
