<?php

/**
 * BaseGtu
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $code
 * @property integer $parent_ref
 * @property integer $gtu_from_date_mask
 * @property timestamp $gtu_from_date
 * @property integer $gtu_to_date_mask
 * @property timestamp $gtu_to_date
 * @property Gtu $Parent
 * @property Doctrine_Collection $Gtu
 * @property Doctrine_Collection $GtuTags
 * @property Doctrine_Collection $Soortenregister
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6401 2009-09-24 16:12:04Z guilhermeblanco $
 */
abstract class BaseGtu extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('gtu');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('code', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('parent_ref', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('gtu_from_date_mask', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('gtu_from_date', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             'default' => '0001-01-01',
             ));
        $this->hasColumn('gtu_to_date_mask', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('gtu_to_date', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             'default' => '0001-01-01',
             ));
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasOne('Gtu as Parent', array(
             'local' => 'parent_ref',
             'foreign' => 'id'));

        $this->hasMany('Gtu', array(
             'local' => 'id',
             'foreign' => 'parent_ref'));

        $this->hasMany('GtuTags', array(
             'local' => 'id',
             'foreign' => 'gtu_ref'));

        $this->hasMany('Soortenregister', array(
             'local' => 'id',
             'foreign' => 'gtu_ref'));
    }
}