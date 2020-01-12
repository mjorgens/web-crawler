<?php
/**
 * CrawlQueue.php
 *
 * PHP version 7.2
 *
 * @category Data_Structure
 * @package  Mjorgens\Crawler\CrawlQueue
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/mjorgens/web-crawler
 */

namespace Mjorgens\Crawler\CrawlQueue;

use Psr\Http\Message\UriInterface;

/**
 * Class CrawlQueue
 *
 * Data structure of a queue of \UriInterface
 *
 * @category Data_Structure
 * @package  Mjorgens\Crawler\CrawlQueue
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/mjorgens/web-crawler
 */
class CrawlQueue implements CrawlQueueInterface
{
    /**
     * The queue
     *
     * @var array
     */
    protected $queue;

    /**
     * CrawlQueue constructor.
     */
    public function __construct()
    {
        $this->queue = [];
    }

    /**
     * Add an UriInterface to the queue
     *
     * @param UriInterface $url The url to add
     *
     * @return void
     */
    public function add(UriInterface $url): void
    {
        // fix the url if missing path
        if ($url->getPath() === '') {
            $url = $url->withPath('/');
        }

        $this->queue[] = $url;
    }

    /**
     * Return the top UriInterface from the queue
     *
     * @return UriInterface
     */
    public function next(): UriInterface
    {
        return array_shift($this->queue);
    }

    /**
     * Check if the queue is empty
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return count($this->queue) === 0;
    }

    /**
     * Return the number of items in the queue
     *
     * @return int
     */
    public function numOfUrls(): int
    {
        return count($this->queue);
    }

    /**
     * Check if the UriInterface is already in the queue
     *
     * @param UriInterface $url The url to check
     *
     * @return bool
     */
    public function contains(UriInterface $url): bool
    {
        // fix the url if missing path
        if ($url->getPath() === '') {
            $url = $url->withPath('/');
        }

        // iterate through the queue
        foreach ($this->queue as $item) {
            // check if the item is the same url. if so return true
            if ($item == $url) {
                return true;
            }
        }

        return false;
    }
}
