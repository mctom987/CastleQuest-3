<?php

class Cq_LoginController extends Zend_Controller_Action
{
    protected $checkAuth = TRUE;
    protected $config;
    
    public function init()
    {
        $this->config = Zend_Registry::get('config');
        return parent::init();
    }

    public function preDispatch()
    {
        if ($this->checkAuth && Zend_Auth::getInstance()->hasIdentity()) {
            $this->_redirect($this->view->url(array('controller'=>'dashboard'), NULL, TRUE), array(), FALSE);
        }
    }
}