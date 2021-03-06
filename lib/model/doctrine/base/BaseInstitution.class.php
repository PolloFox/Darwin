<?php

/**
 * BaseInstitution
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property boolean $is_physical
 * @property string $sub_type
 * @property string $formated_name
 * @property string $formated_name_indexed
 * @property string $formated_name_ts
 * @property string $family_name
 * @property string $additional_names
 * 
 * @method integer     getId()                    Returns the current record's "id" value
 * @method boolean     getIsPhysical()            Returns the current record's "is_physical" value
 * @method string      getSubType()               Returns the current record's "sub_type" value
 * @method string      getFormatedName()          Returns the current record's "formated_name" value
 * @method string      getFormatedNameIndexed()   Returns the current record's "formated_name_indexed" value
 * @method string      getFormatedNameTs()        Returns the current record's "formated_name_ts" value
 * @method string      getFamilyName()            Returns the current record's "family_name" value
 * @method string      getAdditionalNames()       Returns the current record's "additional_names" value
 * @method Institution setId()                    Sets the current record's "id" value
 * @method Institution setIsPhysical()            Sets the current record's "is_physical" value
 * @method Institution setSubType()               Sets the current record's "sub_type" value
 * @method Institution setFormatedName()          Sets the current record's "formated_name" value
 * @method Institution setFormatedNameIndexed()   Sets the current record's "formated_name_indexed" value
 * @method Institution setFormatedNameTs()        Sets the current record's "formated_name_ts" value
 * @method Institution setFamilyName()            Sets the current record's "family_name" value
 * @method Institution setAdditionalNames()       Sets the current record's "additional_names" value
 * 
 * @package    darwin
 * @subpackage model
 * @author     DB team <collections@naturalsciences.be>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInstitution extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('people');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('is_physical', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => false,
             ));
        $this->hasColumn('sub_type', 'string', null, array(
             'type' => 'string',
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
        $this->hasColumn('family_name', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('additional_names', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}