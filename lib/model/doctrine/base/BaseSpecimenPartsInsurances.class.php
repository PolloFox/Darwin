<?php

/**
 * BaseSpecimenPartsInsurances
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $specimen_part_ref
 * @property integer $insurance_year
 * @property integer $insurance_value
 * @property integer $insurer_ref
 * @property SpecimenParts $SpecimenParts
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6401 2009-09-24 16:12:04Z guilhermeblanco $
 */
abstract class BaseSpecimenPartsInsurances extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('specimen_parts_insurances');
        $this->hasColumn('specimen_part_ref', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('insurance_year', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('insurance_value', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('insurer_ref', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasOne('SpecimenParts', array(
             'local' => 'specimen_part_ref',
             'foreign' => 'id'));
    }
}