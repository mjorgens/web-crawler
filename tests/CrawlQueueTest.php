<?php
/**
 * CrawlQueueTest.php
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

use GuzzleHttp\Psr7\Uri;
use Mjorgens\Crawler\CrawlQueue\CrawlQueue;
use Mjorgens\Crawler\CrawlQueue\CrawlQueueInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class CrawlQueueTest
 *
 * Tests for CrawlQueue Class
 *
 * @category Test
 * @package  Tests
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */
class CrawlQueueTest extends TestCase
{

    protected $crawlQueue;
    protected $url1;
    protected $url2;

    /**
     * SetUp method of test
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->crawlQueue = new CrawlQueue();
        $this->url1 = new Uri('https://example1.com/');
        $this->url2 = new Uri('https://example2.com/');
    }

    /**
     * Test for next() method
     *
     * @return void
     */
    public function testNext()
    {
        $this->crawlQueue->add($this->url1);
        $this->crawlQueue->add($this->url2);

        $this->assertSame($this->url1, $this->crawlQueue->next());
        $this->assertSame($this->url2, $this->crawlQueue->next());
    }

    /**
     * Test for __construct()
     *
     * @return void
     */
    public function testConstruct()
    {
        $this->assertTrue($this->crawlQueue instanceof CrawlQueueInterface);
        $this->assertTrue($this->crawlQueue instanceof CrawlQueue);
    }

    /**
     * Test for add() method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->assertSame(0, $this->crawlQueue->numOfUrls());

        $this->crawlQueue->add($this->url1);

        $this->assertSame(1, $this->crawlQueue->numOfUrls());
    }

    /**
     * Test for isEmpty() method
     *
     * @return void
     */
    public function testIsEmpty()
    {
        $this->assertTrue($this->crawlQueue->isEmpty());

        $this->crawlQueue->add($this->url1);

        $this->assertFalse($this->crawlQueue->isEmpty());
    }

    /**
     * Test for numOfUrls() method
     *
     * @return void
     */
    public function testNumOfUrls()
    {
        $this->crawlQueue->add($this->url1);
        $this->crawlQueue->add($this->url2);

        $this->assertSame(2, $this->crawlQueue->numOfUrls());
    }

    /**
     * Test for contains() method
     *
     * @return void
     */
    public function testContains()
    {
        $this->crawlQueue->add($this->url1);

        $this->assertTrue($this->crawlQueue->contains($this->url1));
        self::assertFalse($this->crawlQueue->contains($this->url2));
    }
}
