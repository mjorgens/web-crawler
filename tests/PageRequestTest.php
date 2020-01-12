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

    /**
     * SetUp method of test
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new Client(['timeout' => 2.0]);
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
        $this->url = 'http://example.com';
        $this->badUrl = 'http://puddy.com';
    }

    /**
     * Test getPage() for a good url
     *
     * @return void
     */
    public function testGetPageGoodUrl()
    {
        $page = PageRequest::getPage($this->client, new Uri($this->url));
        $this->assertSame($this->html, $page->html);
        $this->assertSame($this->url, $page->url);
    }

    /**
     * Test getPage() for bad url
     *
     * @return void
     */
    public function testGetPageBadUrl()
    {
        $page = PageRequest::getPage($this->client, new Uri($this->badUrl));
        $this->assertNull($page);
    }
}
