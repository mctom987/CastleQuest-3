<?php

class Cq_Auth_Adapter implements Zend_Auth_Adapter_Interface
{
    const ACCOUNT_NOT_EXISTS = 'loginAccountNotExists';
    const ACCOUNT_NOT_AUTHORIZED = 'loginAccountNotAuthorized';
    const BAD_PASSWORD = 'loginPasswordWrong';
    const BAD_PW = self::BAD_PASSWORD;

    protected $_user;
    protected $_password = '';
    protected $_username = '';

    public function __construct($username, $password)
    {
        $this->_username = $username;
        $this->_password = $password;
    }

    public function authenticate()
    {
        try
        {
            $this->_user = Model_User::authenticate($this->_username, $this->_password);
            return $this->createResult(Zend_Auth_Result::SUCCESS);
        } catch (Exception $e) {
            if (Model_User::NOT_FOUND == $e->getMessage()) {
                return $this->createResult(Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND, array(self::ACCOUNT_NOT_EXISTS));
            }
            if (Model_User::WRONG_PASSWORD == $e->getMessage()) {
                return $this->createResult(Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID, array(self::BAD_PASSWORD));
            }
            die($e->getMessage());
        }
    }

    private function createResult($code, array $messages = array())
    {
        return new Zend_Auth_Result($code, $this->_user, $messages);
    }
}