<?php

/**
 * BaseMyPreferences
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_ref
 * @property string $category
 * @property string $group_name
 * @property integer $order_by
 * @property integer $col_num
 * @property boolean $mandatory
 * @property boolean $visible
 * @property boolean $opened
 * @property string $color
 * @property integer $icon_ref
 * @property string $title_perso
 * @property Users $User
 * @property Multimedia $Multimedia
 * 
 * @method integer       getUserRef()     Returns the current record's "user_ref" value
 * @method string        getCategory()    Returns the current record's "category" value
 * @method string        getGroupName()   Returns the current record's "group_name" value
 * @method integer       getOrderBy()     Returns the current record's "order_by" value
 * @method integer       getColNum()      Returns the current record's "col_num" value
 * @method boolean       getMandatory()   Returns the current record's "mandatory" value
 * @method boolean       getVisible()     Returns the current record's "visible" value
 * @method boolean       getOpened()      Returns the current record's "opened" value
 * @method string        getColor()       Returns the current record's "color" value
 * @method integer       getIconRef()     Returns the current record's "icon_ref" value
 * @method string        getTitlePerso()  Returns the current record's "title_perso" value
 * @method Users         getUser()        Returns the current record's "User" value
 * @method Multimedia    getMultimedia()  Returns the current record's "Multimedia" value
 * @method MyPreferences setUserRef()     Sets the current record's "user_ref" value
 * @method MyPreferences setCategory()    Sets the current record's "category" value
 * @method MyPreferences setGroupName()   Sets the current record's "group_name" value
 * @method MyPreferences setOrderBy()     Sets the current record's "order_by" value
 * @method MyPreferences setColNum()      Sets the current record's "col_num" value
 * @method MyPreferences setMandatory()   Sets the current record's "mandatory" value
 * @method MyPreferences setVisible()     Sets the current record's "visible" value
 * @method MyPreferences setOpened()      Sets the current record's "opened" value
 * @method MyPreferences setColor()       Sets the current record's "color" value
 * @method MyPreferences setIconRef()     Sets the current record's "icon_ref" value
 * @method MyPreferences setTitlePerso()  Sets the current record's "title_perso" value
 * @method MyPreferences setUser()        Sets the current record's "User" value
 * @method MyPreferences setMultimedia()  Sets the current record's "Multimedia" value
 * 
 * @package    darwin
 * @subpackage model
 * @author     DB team <collections@naturalsciences.be>
 * @version    SVN: $Id: Builder.php 7380 2010-03-15 21:07:50Z jwage $
 */
abstract class BaseMyPreferences extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('my_preferences');
        $this->hasColumn('user_ref', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('category', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('group_name', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('order_by', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 1,
             ));
        $this->hasColumn('col_num', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 1,
             ));
        $this->hasColumn('mandatory', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => false,
             ));
        $this->hasColumn('visible', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => true,
             ));
        $this->hasColumn('opened', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => true,
             ));
        $this->hasColumn('color', 'string', null, array(
             'type' => 'string',
             'default' => '#5BAABD',
             ));
        $this->hasColumn('icon_ref', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('title_perso', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Users as User', array(
             'local' => 'user_ref',
             'foreign' => 'id'));

        $this->hasOne('Multimedia', array(
             'local' => 'icon_ref',
             'foreign' => 'id'));
    }
}