<?php

class ErrorController extends Cq_LoginController
{
    public function init() {
        $this->checkAuth = FALSE;
    }

    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');

        switch ($errors->type) { 
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:

                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                
                $this->view->headTitle('Castle Quest 3 - Page Not Found');
                $this->view->message = 'Page not found';
                $this->view->error = 404;
                break;
            default:
                // application error 
                $this->getResponse()->setHttpResponseCode(500);
                $this->view->headTitle = 'Castle Quest 3 - Error';
                $this->view->message = 'Application error';
                $this->view->error = 500;
                break;
        }

        $this->view->exception = $errors->exception;
        $this->view->request   = $errors->request;
    }
}