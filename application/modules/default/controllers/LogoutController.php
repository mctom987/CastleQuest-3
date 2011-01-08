<?php

class LogoutController extends Cq_Controller
{
    public function indexAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect($this->view->url(array(), NULL, TRUE), array(), FALSE);
    }
}