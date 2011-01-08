<?php

class Model_Dao_Announcement extends Doctrine_Table
{
    public function __construct()
    {
        $class = 'Model_Announcement';
        $db = Zend_Registry::get("conn");
        parent::__construct($class, $db, TRUE);
    }

    public function findTopLevel()
    {
        $q = Doctrine_Query::create()
            ->from('Model_Announcement a')
            ->where('a.parent IS NULL');
        return $q->execute();
    }
}