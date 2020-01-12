<?php
/**
 * WebPage.php
 *
 * PHP Version 7.2
 *
 * @property string $url
 * @property string $html
 *
 * @category Model
 * @package  Mjorgens\Crawler\Model
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/mjorgens/web-crawler
 */

namespace Mjorgens\Crawler\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WebPage
 *
 * Data Model of the web page. It holds the url and html of a crawled page.
 *
 * @property string $url
 * @property string $html
 *
 * @category Model
 * @package  Mjorgens\Crawler\Model
 * @author   Marc Jorgensen <marcjorgensen@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/mjorgens/web-crawler
 */
class WebPage extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['url', 'html'];
}
