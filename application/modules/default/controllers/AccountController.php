<?php

class AccountController extends Cq_LoginController
{
    public function registerAction()
    {
        $this->view->headTitle('Registration');
        $this->view->pageTitle($this->view->translate('signup'));
        $form = new ArrayObject;
        $form->action = $this->view->url(array());
        $form->username = $form->email = $form->class = '';

        $this->view->classes = Doctrine::getTable('Model_Class')->findAll();
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParams();
            $user = new Model_User;
            $errors = array();

            try {
                $user->username = $data['username'];
            } catch (Exception $e) {
                // Invalid username
                $errors[] = $e->getMessage();
            }

            try {
                $user->setPassword($data['password'], $data['verifyPassword']);
            } catch (Exception $e) {
                // Invalid password
                $errors[] = $e->getMessage();
            }

            try {
                $user->email = $data['email'];
            } catch (Exception $e) {
                // Invalid email
                $errors[] = $e->getMessage();
            }

            try {
                $classId = NULL;
                $class = Doctrine::getTable('Model_Class')->findOneByName($data['class']);
                if ($class->id) {
                    $classId = $data['class'] = (Int) $class->id;
                }
                $user->classId = $classId;
            } catch (Exception $e) {
                // Invalid class
                $errors[] = $e->getMessage();
            }

            if (empty($data['rules'])) {
                $errors[] = 'SIGNUP_ACCEPT_RULES';
            }

            if (empty($errors)) {
                // Success
                try {
                    $user->ip = $_SERVER['REMOTE_ADDR'];
                    $user->save();
                    $user->dispatchRegistrationEmail();
                } catch (Exception $e) {
                    //Somehow still failed
                    $errors[] = $e->getMessage();
                }
            }

            if (empty($errors)) {
                $session = new Zend_Session_Namespace('game');
                $session->registrationCompleted = TRUE;
                return $this->_redirect($this->view->url(array('action'=>'registration-complete')));
            } else {
                // Failure
                $form->username = $data['username'];
                $form->email    = $data['email'];
                $form->class    = $data['class'];
                $form->rules    = isset($data['rules']);
                $this->view->message = $errors[0];
            }
        }
        $this->view->form = $form;
    }

    public function registrationCompleteAction()
    {
    }
}