# Web Crawler for PHP
![GitHub release (latest by date)](https://img.shields.io/github/v/release/mjorgens/web-crawler) ![GitHub Workflow Status (branch)](https://img.shields.io/github/workflow/status/mjorgens/web-crawler/CI/master) ![GitHub](https://img.shields.io/github/license/mjorgens/web-crawler)

This is a PHP library that takes a starting URL and then parses the page Html 
and extracts the URLs. It then follows the URL and parses those pages until the 
max number of URLs is reached.
## Requirements
![PHP from Packagist](https://img.shields.io/packagist/php-v/mjorgens/web-crawler)

## Installation
The recommended way to install this library is through Composer.

```shell script
composer require mjorgens/web-crawler
```
## Usage

```php
$repository = new \Mjorgens\Crawler\CrawledRepository\CrawledMemoryRepository(); // The collection of pages
$url = new Uri('https://example.com'); // Starting url
$maxUrls = 5; // Max number of urls to crawl

Crawler::create()
            ->setRepository($repository)
            ->setMaxCrawl($maxUrls)
            ->startCrawling($url); // Start the crawler

foreach ($repository as $page){
    echo $page->url;
    echo $page->html;
}
```