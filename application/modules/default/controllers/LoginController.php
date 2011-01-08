<?php

class LoginController extends Cq_LoginController
{
    public function indexAction()
    {
        // Regenerate sessid to prevent session being predetermined by a possible hacker
        session_regenerate_id();

        $username = $this->_getParam('username');
        $password = $this->_getParam('password');

        if ($this->getRequest()->isPost()) {
            if (empty($username) || empty($password)) {
                $this->view->message = 'loginFormIncomplete';
            } else {
                $adapter = new Cq_Auth_Adapter($this->_getParam('username'), $this->_getParam('password'));
                $result = Zend_Auth::getInstance()->authenticate($adapter);
                if (Zend_Auth::getInstance()->hasIdentity()) {
                    $user = Zend_Auth::getInstance()->getIdentity();
                    $user->ip = $_SERVER['REMOTE_ADDR'];
                    $user->save();
                    $this->_redirect($this->view->url(array('controller'=>'dashboard'), NULL, TRUE), array(), FALSE);
                } else {
                    $this->view->message = implode(' ', $result->getMessages());
                }
            }
        }
        $this->_forward(NULL, 'index', NULL, $this->_getAllParams());
    }
}