<?php

/**
 * BasePeopleRelationships
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $relationship_type
 * @property integer $person_1_ref
 * @property integer $person_2_ref
 * @property string $path
 * @property string $activity_date_from
 * @property integer $activity_date_from_mask
 * @property string $activity_date_to
 * @property integer $activity_date_to_mask
 * @property string $person_user_role
 * @property Institutions $Parent
 * @property People $Child
 * 
 * @method integer             getId()                      Returns the current record's "id" value
 * @method string              getRelationshipType()        Returns the current record's "relationship_type" value
 * @method integer             getPerson1Ref()              Returns the current record's "person_1_ref" value
 * @method integer             getPerson2Ref()              Returns the current record's "person_2_ref" value
 * @method string              getPath()                    Returns the current record's "path" value
 * @method string              getActivityDateFrom()        Returns the current record's "activity_date_from" value
 * @method integer             getActivityDateFromMask()    Returns the current record's "activity_date_from_mask" value
 * @method string              getActivityDateTo()          Returns the current record's "activity_date_to" value
 * @method integer             getActivityDateToMask()      Returns the current record's "activity_date_to_mask" value
 * @method string              getPersonUserRole()          Returns the current record's "person_user_role" value
 * @method Institutions        getParent()                  Returns the current record's "Parent" value
 * @method People              getChild()                   Returns the current record's "Child" value
 * @method PeopleRelationships setId()                      Sets the current record's "id" value
 * @method PeopleRelationships setRelationshipType()        Sets the current record's "relationship_type" value
 * @method PeopleRelationships setPerson1Ref()              Sets the current record's "person_1_ref" value
 * @method PeopleRelationships setPerson2Ref()              Sets the current record's "person_2_ref" value
 * @method PeopleRelationships setPath()                    Sets the current record's "path" value
 * @method PeopleRelationships setActivityDateFrom()        Sets the current record's "activity_date_from" value
 * @method PeopleRelationships setActivityDateFromMask()    Sets the current record's "activity_date_from_mask" value
 * @method PeopleRelationships setActivityDateTo()          Sets the current record's "activity_date_to" value
 * @method PeopleRelationships setActivityDateToMask()      Sets the current record's "activity_date_to_mask" value
 * @method PeopleRelationships setPersonUserRole()          Sets the current record's "person_user_role" value
 * @method PeopleRelationships setParent()                  Sets the current record's "Parent" value
 * @method PeopleRelationships setChild()                   Sets the current record's "Child" value
 * 
 * @package    darwin
 * @subpackage model
 * @author     DB team <collections@naturalsciences.be>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePeopleRelationships extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('people_relationships');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('relationship_type', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             'default' => 'belongs to',
             ));
        $this->hasColumn('person_1_ref', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('person_2_ref', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('path', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('activity_date_from', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '0001-01-01',
             ));
        $this->hasColumn('activity_date_from_mask', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('activity_date_to', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '2038-12-31',
             ));
        $this->hasColumn('activity_date_to_mask', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('person_user_role', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Institutions as Parent', array(
             'local' => 'person_1_ref',
             'foreign' => 'id'));

        $this->hasOne('People as Child', array(
             'local' => 'person_2_ref',
             'foreign' => 'id'));
    }
}