<?php

/**
 * BaseUsers
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property boolean $is_physical
 * @property string $sub_type
 * @property enum $public_class
 * @property string $formated_name
 * @property string $formated_name_indexed
 * @property string $formated_name_ts
 * @property string $title
 * @property string $family_name
 * @property string $given_name
 * @property string $additional_names
 * @property integer $birth_date_mask
 * @property date $birth_date
 * @property enum $gender
 * @property integer $db_user_type
 * @property Doctrine_Collection $UsersLanguages
 * @property Doctrine_Collection $UsersComm
 * @property Doctrine_Collection $UsersAddresses
 * @property Doctrine_Collection $UsersLoginInfos
 * @property Doctrine_Collection $UsersMultimedia
 * @property Doctrine_Collection $Collections
 * @property Doctrine_Collection $CollectionsAdmin
 * @property Doctrine_Collection $CollectionsRights
 * @property Doctrine_Collection $CollectionsFieldsVisibilities
 * @property Doctrine_Collection $UsersCollRightsAsked
 * @property Doctrine_Collection $RecordVisibilities
 * @property Doctrine_Collection $UsersWorkflow
 * @property Doctrine_Collection $UsersTablesFieldsTracked
 * @property Doctrine_Collection $UsersTracking
 * @property Doctrine_Collection $CollectionMaintenance
 * @property Doctrine_Collection $MySavedSearches
 * @property Doctrine_Collection $MyPreferences
 * @property Doctrine_Collection $MySavedSpecimens
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6401 2009-09-24 16:12:04Z guilhermeblanco $
 */
abstract class BaseUsers extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('users');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('is_physical', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             ));
        $this->hasColumn('sub_type', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('public_class', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'public',
              1 => 'private',
             ),
             ));
        $this->hasColumn('formated_name', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('formated_name_indexed', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('formated_name_ts', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('title', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('family_name', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('given_name', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('additional_names', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('birth_date_mask', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('birth_date', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             'default' => '0001-01-01',
             ));
        $this->hasColumn('gender', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'M',
              1 => 'F',
             ),
             ));
        $this->hasColumn('db_user_type', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => '1',
             ));
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasMany('UsersLanguages', array(
             'local' => 'id',
             'foreign' => 'users_ref'));

        $this->hasMany('UsersComm', array(
             'local' => 'id',
             'foreign' => 'person_user_ref'));

        $this->hasMany('UsersAddresses', array(
             'local' => 'id',
             'foreign' => 'person_user_ref'));

        $this->hasMany('UsersLoginInfos', array(
             'local' => 'id',
             'foreign' => 'user_ref'));

        $this->hasMany('UsersMultimedia', array(
             'local' => 'id',
             'foreign' => 'person_user_ref'));

        $this->hasMany('Collections', array(
             'local' => 'id',
             'foreign' => 'main_manager_ref'));

        $this->hasMany('CollectionsAdmin', array(
             'local' => 'id',
             'foreign' => 'user_ref'));

        $this->hasMany('CollectionsRights', array(
             'local' => 'id',
             'foreign' => 'user_ref'));

        $this->hasMany('CollectionsFieldsVisibilities', array(
             'local' => 'id',
             'foreign' => 'user_ref'));

        $this->hasMany('UsersCollRightsAsked', array(
             'local' => 'id',
             'foreign' => 'user_ref'));

        $this->hasMany('RecordVisibilities', array(
             'local' => 'id',
             'foreign' => 'user_ref'));

        $this->hasMany('UsersWorkflow', array(
             'local' => 'id',
             'foreign' => 'user_ref'));

        $this->hasMany('UsersTablesFieldsTracked', array(
             'local' => 'id',
             'foreign' => 'user_ref'));

        $this->hasMany('UsersTracking', array(
             'local' => 'id',
             'foreign' => 'user_ref'));

        $this->hasMany('CollectionMaintenance', array(
             'local' => 'id',
             'foreign' => 'user_ref'));

        $this->hasMany('MySavedSearches', array(
             'local' => 'id',
             'foreign' => 'user_ref'));

        $this->hasMany('MyPreferences', array(
             'local' => 'id',
             'foreign' => 'user_ref'));

        $this->hasMany('MySavedSpecimens', array(
             'local' => 'id',
             'foreign' => 'user_ref'));
    }
}