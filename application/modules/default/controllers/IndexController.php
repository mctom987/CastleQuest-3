<?php

class IndexController extends Cq_LoginController
{
    public function indexAction()
    {
        $this->view->headTitle('Castle Quest 3');
        $this->view->pageTitle($this->view->translate('login'));
        $form = new ArrayObject;
        $form->username = $this->_getParam('username');
        $form->action = $this->view->url(array('controller'=>'login'), NULL, TRUE);
        $this->view->form = $form;
    }
}