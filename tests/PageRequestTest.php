<?php
/**
 * PageRequestTest.php
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
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Uri;
use Mjorgens\Crawler\PageRequest\PageRequest;
use PHPUnit\Framework\TestCase;

/**
 * Class PageRequestTest
 *
 * Tests for PageRequest Class
 *
 * @category Test
 * @package  Tests
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */
class PageRequestTest extends TestCase
{
    protected $html;
    protected $url;
    protected $badUrl;
    protected $client;
    protected $mock;

    /**
     * SetUp method of test
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->mock = new MockHandler();
        $this->client = new Client(['handler' => $this->mock,]);
        $this->html = '<html><div>Test</div></html>';
        $this->url = 'http://goodurl.com';
        $this->badUrl = 'http://badurl.com';
    }

    /**
     * Test getPage() for a good url
     *
     * @return void
     */
    public function testGetPageGoodUrl()
    {
        $this->mock->append(new Response(200, [], $this->html));

        $page = PageRequest::getPage($this->client, new Uri($this->url));
        $this->assertSame($this->html, $page->html);
        $this->assertSame($this->url, $page->url);
    }

    /**
     * Test getPage() for bad url with 400 level error
     *
     * @return void
     */
    public function testGetPageBadUrl400()
    {
        $this->mock->append(new ClientException('Not Found', new Request('GET', $this->badUrl)));
        $page = PageRequest::getPage($this->client, new Uri($this->badUrl));
        $this->assertNull($page);
    }

    /**
     * Test getPage() for bad url with 500level error
     *
     * @return void
     */
    public function testGetPageBadUrl500()
    {
        $this->mock->append(new ServerException('Gateway Timeout', new Request('GET', $this->badUrl)));
        $page = PageRequest::getPage($this->client, new Uri($this->badUrl));
        $this->assertNull($page);
    }
}
