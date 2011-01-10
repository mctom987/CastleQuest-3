<?php

class CharacterController extends Cq_Controller
{
    public function indexAction()
    {
        $this->view->headTitle('Character');
        $this->view->pageTitle($this->view->translate('characterPageTitle'));
        $this->view->user = Zend_Registry::get('user');
    }
}