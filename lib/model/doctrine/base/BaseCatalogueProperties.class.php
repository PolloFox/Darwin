<?php

/**
 * BaseCatalogueProperties
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $referenced_relation
 * @property integer $record_id
 * @property string $property_type
 * @property string $property_sub_type
 * @property string $property_sub_type_indexed
 * @property string $property_qualifier
 * @property string $property_qualifier_indexed
 * @property integer $date_from_mask
 * @property timestamp $date_from timestamp
 * @property integer $date_to_mask
 * @property timestamp $date_to timestamp
 * @property string $property_unit
 * @property string $property_accuracy_unit
 * @property string $property_method
 * @property string $property_method_indexed
 * @property string $property_tool
 * @property string $property_tool_indexed
 * @property Doctrine_Collection $PropertiesValues
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6401 2009-09-24 16:12:04Z guilhermeblanco $
 */
abstract class BaseCatalogueProperties extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('catalogue_properties');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('referenced_relation', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('record_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('property_type', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('property_sub_type', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('property_sub_type_indexed', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('property_qualifier', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('property_qualifier_indexed', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('date_from_mask', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('date_from timestamp', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             'default' => '0001-01-01',
             ));
        $this->hasColumn('date_to_mask', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('date_to timestamp', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             'default' => '0001-01-01',
             ));
        $this->hasColumn('property_unit', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('property_accuracy_unit', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('property_method', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('property_method_indexed', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('property_tool', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('property_tool_indexed', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasMany('PropertiesValues', array(
             'local' => 'id',
             'foreign' => 'property_ref'));
    }
}