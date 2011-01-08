<?php
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(TRUE);
$config = new Zend_Config_Ini('../application/configs/application.ini', 'development');
$options = $config->doctrine->options->toArray();

error_reporting($config->phpSettings->error_reporting);
ini_set('display_errors', $config->phpSettings->display_errors);

$conn = Doctrine_Manager::connection($config->doctrine->dsn);
$conn->setAttribute(Doctrine::ATTR_USE_NATIVE_ENUM, TRUE);

if (Doctrine::generateModelsFromDb($config->doctrine->modelsPath, array(), $options))
    echo 'Success';
else
    echo 'Failure';