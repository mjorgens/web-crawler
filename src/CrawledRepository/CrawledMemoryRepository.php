<?php
/**
 * CrawledMemoryRepository.php
 *
 * PHP version 7.2
 *
 * @category Data_Structure
 * @package  Mjorgens\Crawler\CrawledRepository
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/mjorgens/web-crawler
 */

namespace Mjorgens\Crawler\CrawledRepository;

use GuzzleHttp\Psr7\Uri;
use Mjorgens\Crawler\Model\WebPage;
use Psr\Http\Message\UriInterface;

/**
 * Class CrawledMemoryRepository
 *
 * Data structure that contains a collection of WebPage.
 * This implementation is in memory
 *
 * @category Data_Structure
 * @package  Mjorgens\Crawler\CrawledRepository
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/mjorgens/web-crawler
 */
class CrawledMemoryRepository implements CrawledRepositoryInterface
{
    /**
     * All the WebPages
     *
     * @var array
     */
    protected $repository;

    /**
     * CrawledMemoryRepository constructor.
     */
    public function __construct()
    {
        $this->repository = [];
    }

    /**
     * Return all of the WebPage in the repository
     *
     * @return array
     */
    public function all(): array
    {
        return $this->repository;
    }

    /**
     * Find the WebPage by the url from the repository.
     * If not returns null.
     *
     * @param UriInterface $url Url to search for
     *
     * @return WebPage|null
     */
    public function find(UriInterface $url): ?WebPage
    {
        // iterate through the repository
        foreach ($this->repository as $page) {
            // check if the item url is the same url. if so return true
            if ($page->url == (string)$url) {
                return $page;
            }
        }

        return null;
    }

    /**
     * Add a WebPage to the repository
     *
     * @param WebPage $page Web page to add
     *
     * @return void
     */
    public function add(WebPage $page): void
    {
        if (!$this->contains(new Uri($page->url))) {
            $this->repository[] = $page;
        }
    }

    /**
     * Checks if WebPage is in the repository by url
     *
     * @param UriInterface $url Url to search for
     *
     * @return bool
     */
    public function contains(UriInterface $url): bool
    {
        return $this->find($url) !== null;
    }

    /**
     * Returns the number of items in the repository
     *
     * @return int
     */
    public function numOfPages(): int
    {
        return count($this->repository);
    }

    /**
     * Deletes all of the stored pages in the repository
     *
     * @return void
     */
    public function clear()
    {
        $this->repository = array();
    }
}
