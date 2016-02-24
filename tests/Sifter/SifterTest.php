<?php namespace Tests\Sifter;


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
    }

    public function testAllProjects() {
        $sifter = new Sifter(self::$apiKey, self::$apiSubdomain);
        $projects = $sifter->allProjects();

        $this->assertTrue(is_array($projects));
    }

    public function testProject() {

    }

    public function testIssuesThroughProject() {
        $sifter = new Sifter(self::$apiKey, self::$apiSubdomain);
        $projects = $sifter->allProjects();

        $this->assertTrue(is_array($projects));
        $this->assertNotEmpty($projects);
        $issues = $projects[0]->issues();
        $issue = $issues->first();
        $this->assertInstanceOf('Sifter\Resource\IssuesResource', $issues);
        $this->assertInstanceOf('Sifter\Model\Issue', $issue);
        $this->assertInstanceOf('Carbon\Carbon', $issue->getCreatedAt());
        $this->assertInstanceOf('Carbon\Carbon', $issue->getUpdatedAt());
    }


}
