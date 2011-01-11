<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initAppAutoload()
    {
        $ml = new Zend_Application_Module_Autoloader(
            array('namespace'=>'','basePath'=>APPLICATION_PATH)
        );
    }

    public function _initDoctrine()
    {
        $doctrineConfig = $this->getOption('doctrine');
        $manager = Doctrine_Manager::getInstance();
        $manager->setAttribute(Doctrine::ATTR_AUTO_ACCESSOR_OVERRIDE, TRUE);
        $manager->setAttribute(Doctrine::ATTR_MODEL_LOADING, $doctrineConfig['modelAutoloading']);
        $manager->setAttribute(Doctrine::ATTR_VALIDATE, Doctrine::VALIDATE_ALL);
        Doctrine::loadModels($doctrineConfig['modelsPath']);

        $conn = Doctrine_Manager::connection($doctrineConfig['dsn'], 'doctrine');
        $conn->setAttribute(Doctrine::ATTR_USE_NATIVE_ENUM, TRUE);
        $conn->setAttribute(Doctrine::ATTR_QUOTE_IDENTIFIER, TRUE);
        Zend_Registry::set('conn', $conn);
    }

    public function _initDoctype()
    {
        $config = Zend_Registry::get('config');
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
        $view->addHelperPath(APPLICATION_PATH . '/views/helpers')
             ->addHelperPath('Zend/Dojo/View/Helper', 'Zend_Dojo_View_Helper');
        $view->headMeta()->prependHttpEquiv('Content-Type', 'text/html;charset=utf-8')
                         ->setindent(2);
        $view->headTitle()->setPrefix($config->game->title->prefix)
                          ->setPostfix($config->game->title->postfix)
                          ->setindent(2);
        $view->headLink()->prependStylesheet('/css/red.css')
                         ->setindent(2);
    }

    public function _initNavigation()
    {
        $view = $this->getResource('view');
        $navigation = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'navigation');
        $view->defaultNavigation = new Zend_Navigation($navigation->default);
        $view->gameMenu = new Zend_Navigation($navigation->gameMenu);
        $view->otherLinks = new Zend_Navigation($navigation->otherLinks);
        $view->adminNavigation = new Zend_Navigation($navigation->admin);
    }

    public function _initUserSession()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $user = Doctrine::getTable('Model_User')->find($auth->getIdentity()->id);
        } else {
            $user = new Model_User;
        }

        Zend_Registry::set('user', $user);
    }

    public function _initTranslationLocale()
    {
        $this->bootstrap('translate');
        $t = $this->getResource('translate');
        // This is broken in ZF 1.11.1
        /*if (!$t->isAvailable($t->getLocale())) {
            $t->setLocale(Zend_Registry::get('config')->resources->translate->defaultLocale);
        }*/
        if (!$t->isTranslated('login')) {
            $t->setLocale(Zend_Registry::get('config')->resources->translate->defaultLocale);
        }
    }
}