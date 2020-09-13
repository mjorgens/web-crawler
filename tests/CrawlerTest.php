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
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
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
    protected $html2;
    protected $client;

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
<!DOCTYPE html>
<html>
    <body>
        <p class="message">Hello World!</p>
        <p>Hello Crawler!</p>
        <a href="https://example1.com/">Test</a>
        <a href="https://example2.com/">Test</a>
    </body>
</html>
HTML;
        $this->html2 = '<html><div>Test</div></html>';

        $mock = new MockHandler([
            new Response(200, [], $this->html),
            new Response(200, [], $this->html2),
            new Response(200, [], $this->html2),
        ]);
        $handlerStack = HandlerStack::create($mock);
        $this->client = new Client(['handler' => $handlerStack]);
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
            ->setClient($this->client)
            ->setMaxCrawl(3)
            ->setRepository($repository)
            ->startCrawling($url);
        $this->assertSame(3, $repository->numOfPages());
        $this->assertSame($this->html, $repository->all()[0]->html);
        $this->assertSame($this->html2, $repository->all()[1]->html);
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
            ->setClient($this->client)
            ->setMaxCrawl(2)
            ->setRepository($repository)
            ->startCrawling(new Uri($url));
        $this->assertSame(2, $repository->numOfPages());
        $this->assertSame($this->html2, $repository->all()[1]->html);
    }

    /**
     * Test for getRepository() method
     *
     * @return void
     */
    public function testGetRepository()
    {
        $this->assertTrue(
            $this->crawler->getRepository() instanceof CrawledRepositoryInterface
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
