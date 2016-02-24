<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 2016-02-23
 * Time: 11:13 PM
 */

namespace Tests\Sifter;


use josegonzalez\Dotenv\Loader;
use Sifter\Sifter;

class SifterTest extends \PHPUnit_Framework_TestCase
{
    private static $apiKey;
    private static $apiSubdomain;

    public static function setUpBeforeClass()
    {
        $loader = new Loader(__DIR__.'/../../.env');
        $loader->parse()->toEnv();
        self::$apiKey = (isset($_ENV['SIFTER_API_KEY'])?$_ENV['SIFTER_API_KEY']:null);
        self::$apiSubdomain = (isset($_ENV['SIFTER_API_SUBDOMAIN'])?$_ENV['SIFTER_API_SUBDOMAIN']:null);
    }

    public function testEnvironmentSet() {
        $this->assertNotNull(self::$apiKey);
        $this->assertNotNull(self::$apiSubdomain);
    }

    public function testConstruct() {
        $sifter = new Sifter('1234', 'example');

        $this->assertEquals('https://example.sifterapp.com/api/', $sifter->getApiBaseUrl());
        $this->assertArrayHasKey('Accept', $sifter->getHeaders());
        $this->assertArrayHasKey('X-Sifter-Token', $sifter->getHeaders());
        $this->assertEquals('application/json', $sifter->getHeader('Accept'));
        $this->assertEquals('1234', $sifter->getHeader('X-Sifter-Token'));
    }

    public function testAllProjects() {
        $sifter = new Sifter(self::$apiKey, self::$apiSubdomain);
        $projects = $sifter->allProjects();

        $this->assertTrue(is_array($projects));

        if(count($projects) > 0) {
            $project = $projects[0];
            $this->assertInstanceOf('Sifter\Project', $project);
        }
    }


}
