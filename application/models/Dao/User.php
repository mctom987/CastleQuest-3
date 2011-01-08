<?php

class Model_Dao_User extends Doctrine_Table
{
    public function __construct()
    {
        $class = 'Model_User';
        $db = Zend_Registry::get("conn");
        parent::__construct($class, $db, TRUE);
    }
}