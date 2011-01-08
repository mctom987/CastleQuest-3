<?php

class Plugin_LayoutSelector extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $layout = Zend_Layout::getMvcInstance();
        $module = $request->getModuleName();
        $layout->setLayoutPath(APPLICATION_PATH . '/modules/' . $module . '/layouts');

        $frontController = Zend_Controller_Front::getInstance();
        $errorHandler = $frontController->getPlugin('Zend_Controller_Plugin_ErrorHandler');
        $errorHandler->setErrorHandlerModule($module);

        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $layout->setLayout('auth');
        }
    }
}