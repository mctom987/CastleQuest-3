<?php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 'On');
define('APPLICATION_ENV', 'development');
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    get_include_path(),
    realpath(APPLICATION_PATH . '/../library'),
    realpath(APPLICATION_PATH . '/models'),
)));

/** Zend_Autoloader */
require_once 'Zend/Loader/Autoloader.php';
$autoloader = Zend_Loader_Autoloader::getInstance();

$config = new Zend_Config_Ini(APPLICATION_PATH
            . '/configs/application.ini', APPLICATION_ENV);
Zend_Registry::set('config', $config);

// Create application, bootstrap, and run
$application = new Zend_Application(APPLICATION_ENV, $config);
$application->bootstrap()
            ->run();