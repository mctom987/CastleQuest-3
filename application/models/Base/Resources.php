<?php

/**
 * Model_Base_Resources
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $power
 * @property integer $powerBalance
 * @property integer $brimstone
 * @property integer $crystal
 * @property integer $essence
 * @property integer $granite
 * @property integer $runestone
 * @property Model_Character $Character
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Model_Base_Resources extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('resources');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('power', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'default' => '500',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('powerBalance', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'default' => '100',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('brimstone', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'default' => '1000',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('crystal', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'default' => '1000',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('essence', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'default' => '1000',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('granite', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'default' => '1000',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('runestone', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Model_Character as Character', array(
             'local' => 'id',
             'foreign' => 'id'));
    }
}