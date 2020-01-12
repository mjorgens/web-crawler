<?php
/**
 * CrawledRepositoryInterface.php
 *
 * PHP version 7.2
 *
 * @category Interface
 * @package  Mjorgens\Crawler\CrawledRepository
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/mjorgens/web-crawler
 */

namespace Mjorgens\Crawler\CrawledRepository;

use Mjorgens\Crawler\Model\WebPage;
use Psr\Http\Message\UriInterface;

/**
 * Interface CrawledRepositoryInterface
 *
 * @category Interface
 * @package  Mjorgens\Crawler\CrawledRepository
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/mjorgens/web-crawler
 */
interface CrawledRepositoryInterface
{
    /**
     * Return all of the WebPage in the repository
     *
     * @return array
     */
    public function all(): array;

    /**
     * Find the WebPage by the url from the repository.
     * If not returns null.
     *
     * @param UriInterface $url Url to search for
     *
     * @return WebPage|null
     */
    public function find(UriInterface $url): ?WebPage;

    /**
     * Add a WebPage to the repository
     *
     * @param WebPage $page Web page to add
     *
     * @return void
     */
    public function add(WebPage $page);

    /**
     * Checks if WebPage is in the repository by url
     *
     * @param UriInterface $url Url to search for
     *
     * @return bool
     */
    public function contains(UriInterface $url): bool;

    /**
     * Returns the number of items in the repository
     *
     * @return int
     */
    public function numOfPages(): int;

    /**
     * Deletes all of the stored pages in the repository
     *
     * @return void
     */
    public function clear();
}
