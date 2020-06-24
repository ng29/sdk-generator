<?php

require_once (__DIR__.'/../vendor/autoload.php');

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Chrome;

$javaPath = '"C:\\Program Files (x86)\\Common Files\\Oracle\\Java\\javapath\\java.exe"';
$seleniumPath = '"'. __DIR__ . '\\..\\selenium-server-standalone-3.141.5.jar"';

$chromeDriverPath = 'C:\path\to\chromedriver.exe';
$site = 'http://mytestsite';

$seleniumPort = 4445;
$useSelenium = true;
$chromeDriverPathEnvVar = 'webdriver.chrome.driver';

putenv( $chromeDriverPathEnvVar .'='. $chromeDriverPath );

$chromeOptions = new Chrome\ChromeOptions();
$chromeOptions->addArguments( array( '--headless' ) );

$chromeCapabilities = DesiredCapabilities::chrome();
$chromeCapabilities->setCapability( Chrome\ChromeOptions::CAPABILITY, $chromeOptions );
$chromeCapabilities->setCapability( 'loggingPrefs', ['browser' => 'ALL'] );

$selenium = null;

if ($useSelenium) {

    $descriptorspec = array(
        0 => array('pipe', 'r'),  // stdin is a pipe that the child will read from
        1 => array('file', __DIR__ . '/selenium_log-' . date('Ymd-His').'_'. $seleniumPort . '-stdout.txt', 'a'),  // stdout is a pipe that the child will write to
        2 => array('file', __DIR__ . '/selenium_log-' . date('Ymd-His').'_'. $seleniumPort . '-stderr.txt', 'a')   // stderr is a file to write to
    );

    $selenium_cmd = $javaPath .' -D'. $chromeDriverPathEnvVar .'="'. $chromeDriverPath .'" -jar '. $seleniumPath .' -port '. $seleniumPort; // If interested, add .' -debug';
    $selenium = proc_open( $selenium_cmd, $descriptorspec, $pipes, null, null, array( 'bypass_shell' => true ) );

    $host = 'http://localhost:'. $seleniumPort .'/wd/hub'; // this is the default
    $chromeDriver = RemoteWebDriver::create($host, $chromeCapabilities );

} else {

    $chromeDriver = Facebook\WebDriver\Chrome\ChromeDriver::start( $chromeCapabilities );
}

$chromeDriver->get( $site );

var_dump( $chromeDriver->manage()->getLog( 'browser' ) );

$chromeDriver->quit(); sleep(1);
$chromeDriver->action(); sleep(1);
$chromeDriver->close();

if ($useSelenium) {

    fclose( $pipes[0] );
    proc_terminate( $selenium );
    @pclose( $selenium );
}