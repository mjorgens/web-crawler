<?php
/**
 * LinkParserTest.php
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
use Mjorgens\Crawler\LinkParser\LinkParser;
use PHPUnit\Framework\TestCase;

/**
 * Class LinkParserTest
 *
 * Tests for LinkParser class
 *
 * @category Test
 * @package  Tests
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */
class LinkParserTest extends TestCase
{
    protected $html;
    protected $url;

    /**
     * SetUp method of test
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->url= new Uri('https://example1.com/');
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
    }

    /**
     * Test for parseLinks() method
     *
     * @return void
     */
    public function testParseLinks()
    {
        $links = LinkParser::parseLinks($this->html, $this->url);
        $this->assertIsArray($links);
        $this->assertSame(2, count($links));

    }
}
