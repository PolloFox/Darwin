<?php

/**
 * BaseLithostratigraphy
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property string $name_indexed
 * @property integer $level_ref
 * @property string $status
 * @property string $path
 * @property integer $parent_ref
 * @property integer $group_ref
 * @property string $group_indexed
 * @property integer $formation_ref
 * @property string $formation_indexed
 * @property integer $member_ref
 * @property string $member_indexed
 * @property integer $layer_ref
 * @property string $layer_indexed
 * @property integer $sub_level_1_ref
 * @property string $sub_level_1_indexed
 * @property integer $sub_level_2_ref
 * @property string $sub_level_2_indexed
 * @property Lithostratigraphy $Parent
 * @property Doctrine_Collection $Lithostratigraphy
 * @property Doctrine_Collection $Specimens
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6401 2009-09-24 16:12:04Z guilhermeblanco $
 */
abstract class BaseLithostratigraphy extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lithostratigraphy');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('name_indexed', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('level_ref', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('status', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             'default' => 'valid',
             ));
        $this->hasColumn('path', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '/',
             ));
        $this->hasColumn('parent_ref', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('group_ref', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('group_indexed', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '',
             ));
        $this->hasColumn('formation_ref', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('formation_indexed', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '',
             ));
        $this->hasColumn('member_ref', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('member_indexed', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '',
             ));
        $this->hasColumn('layer_ref', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('layer_indexed', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '',
             ));
        $this->hasColumn('sub_level_1_ref', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('sub_level_1_indexed', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '',
             ));
        $this->hasColumn('sub_level_2_ref', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('sub_level_2_indexed', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasOne('Lithostratigraphy as Parent', array(
             'local' => 'parent_ref',
             'foreign' => 'id'));

        $this->hasMany('Lithostratigraphy', array(
             'local' => 'id',
             'foreign' => 'parent_ref'));

        $this->hasMany('Specimens', array(
             'local' => 'id',
             'foreign' => 'litho_ref'));
    }
}