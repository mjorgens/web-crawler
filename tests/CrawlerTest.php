<?php
/**
 * CrawlerTest.php
 *
 * PHP version 7.2
 *
 * @category Test
 * @package  Tests
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */

namespace Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use Mjorgens\Crawler\CrawledRepository\CrawledMemoryRepository;
use Mjorgens\Crawler\CrawledRepository\CrawledRepositoryInterface;
use Mjorgens\Crawler\Crawler;
use Mjorgens\Crawler\Model\WebPage;
use PHPUnit\Framework\TestCase;

/**
 * Class CrawlerTest
 *
 * Tests for the Crawler Class
 *
 * @category Test
 * @package  Tests
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */
class CrawlerTest extends TestCase
{

    protected $crawler;
    protected $html;

    /**
     * SetUp method of test
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->crawler = new Crawler();
        $this->html = <<<'HTML'
<!doctype html>
<html>
<head>
    <title>Example Domain</title>

    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style type="text/css">
    body {
        background-color: #f0f0f2;
        margin: 0;
        padding: 0;
        font-family: -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
        
    }
    div {
        width: 600px;
        margin: 5em auto;
        padding: 2em;
        background-color: #fdfdff;
        border-radius: 0.5em;
        box-shadow: 2px 3px 7px 2px rgba(0,0,0,0.02);
    }
    a:link, a:visited {
        color: #38488f;
        text-decoration: none;
    }
    @media (max-width: 700px) {
        div {
            margin: 0 auto;
            width: auto;
        }
    }
    </style>    
</head>

<body>
<div>
    <h1>Example Domain</h1>
    <p>This domain is for use in illustrative examples in documents. You may use this
    domain in literature without prior coordination or asking for permission.</p>
    <p><a href="https://www.iana.org/domains/example">More information...</a></p>
</div>
</body>
</html>

HTML;
    }

    /**
     * Test for __construct()
     *
     * @return void
     */
    public function testConstruct()
    {
        $this->assertTrue($this->crawler instanceof Crawler);
    }

    /**
     * Test for getBaseUrl() method
     *
     * @return void
     */
    public function testGetBaseUrl()
    {
        $this->assertTrue($this->crawler->getBaseUrl() instanceof Uri);
    }

    /**
     * Test for getMaxCrawl() method
     *
     * @return void
     */
    public function testGetMaxCrawl()
    {
        $this->assertSame(20, $this->crawler->getMaxCrawl());
    }

    /**
     * Test for create() method
     *
     * @return void
     */
    public function testCreate()
    {
        $this->assertTrue(Crawler::create() instanceof Crawler);
    }

    /**
     * Test for setMaxCrawl() method
     *
     * @return void
     */
    public function testSetMaxCrawl()
    {
        $returnedCrawler = $this->crawler->setMaxCrawl(10);
        $this->assertTrue($returnedCrawler instanceof Crawler);
        $this->assertSame(10, $returnedCrawler->getMaxCrawl());
    }

    /**
     * Test for setRepository() method
     *
     * @return void
     */
    public function testSetRepository()
    {
        $repository = new CrawledMemoryRepository();
        $returnedCrawler = $this->crawler->setRepository($repository);
        $this->assertTrue($returnedCrawler instanceof Crawler);
        $this->assertSame($repository, $returnedCrawler->getRepository());
    }

    /**
     * Test for startCrawling() method with a memory repository
     *
     * @return void
     */
    public function testStartCrawlingMemoryRepository()
    {
        $repository = new CrawledMemoryRepository();
        $url = new Uri('http://example.com/');
        Crawler::create()
            ->setMaxCrawl(5)
            ->setRepository($repository)
            ->startCrawling($url);
        $this->assertSame(5, $repository->numOfPages());
        $this->assertSame($this->html, $repository->all()[0]->html);
    }

    /**
     * Test for startCrawling() method with a memory repository
     * where the page is already in the repository
     *
     * @return void
     */
    public function testStartCrawlingAlreadyInMemoryRepository()
    {
        $repository = new CrawledMemoryRepository();
        $url = 'http://example.com/';
        $page = new WebPage();
        $page->url = $url;
        $page->html = $this->html;
        $repository->add($page);
        Crawler::create()
            ->setMaxCrawl(2)
            ->setRepository($repository)
            ->startCrawling(new Uri($url));
        $this->assertSame(2, $repository->numOfPages());
    }

    /**
     * Test for getRepository() method
     *
     * @return void
     */
    public function testGetRepository()
    {
        $this->assertTrue(
            $this->crawler
                ->getRepository() instanceof CrawledRepositoryInterface
        );
    }

    /**
     * Test for setBaseUrl() method
     *
     * @return void
     */
    public function testSetBaseUrl()
    {
        $url = new Uri('https://example1.com/');
        $returnedCrawler = $this->crawler->setBaseUrl($url);
        $this->assertTrue($returnedCrawler instanceof Crawler);
        $this->assertSame($url, $returnedCrawler->getBaseUrl());
    }

    /**
     * Test for getClient() method
     *
     * @return void
     */
    public function testGetClient()
    {
        $this->assertTrue($this->crawler->getClient() instanceof Client);
    }

    /**
     * Test for setClient() method
     *
     * @return void
     */
    public function testSetClient()
    {
        $client = new Client();
        $returnedCrawler = $this->crawler->setClient($client);
        $this->assertTrue($returnedCrawler instanceof Crawler);
        $this->assertSame($client, $returnedCrawler->getClient());
    }
}
