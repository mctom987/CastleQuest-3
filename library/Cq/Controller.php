<?php

class Cq_Controller extends Zend_Controller_Action
{
    protected $config;

    public function init()
    {
        $this->config = Zend_Registry::get('config');
        $this->view->user = Zend_Auth::getInstance()->getIdentity();
        return parent::init();
    }

    public function preDispatch()
    {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_redirect($this->view->url(array(), NULL, TRUE), array(), FALSE);
        }
    }
}