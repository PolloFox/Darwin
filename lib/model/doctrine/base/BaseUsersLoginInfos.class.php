<?php

/**
 * BaseUsersLoginInfos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_ref
 * @property string $login_type
 * @property string $user_name
 * @property string $password
 * @property string $system_id
 * @property timestamp $last_seen
 * @property Users $User
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6401 2009-09-24 16:12:04Z guilhermeblanco $
 */
abstract class BaseUsersLoginInfos extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('users_login_infos');
        $this->hasColumn('user_ref', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('login_type', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             'default' => 'local',
             ));
        $this->hasColumn('user_name', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('password', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('system_id', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('last_seen', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasOne('Users as User', array(
             'local' => 'user_ref',
             'foreign' => 'id'));
    }
}