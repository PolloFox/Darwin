<?php

/**
 * BaseCodes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $referenced_relation
 * @property integer $record_id
 * @property string $code_category
 * @property string $code_prefix
 * @property integer $code
 * @property string $code_suffix
 * @property string $full_code_indexed
 * @property timestamp $code_date
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6401 2009-09-24 16:12:04Z guilhermeblanco $
 */
abstract class BaseCodes extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('codes');
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
        $this->hasColumn('code_category', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             'default' => 'main',
             ));
        $this->hasColumn('code_prefix', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('code', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('code_suffix', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('full_code_indexed', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('code_date', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
    }

}