<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CodesTable extends DarwinTable
{
  /**
  * Get Distincts prefix separators
  * @return array an Array of types in keys
  */
  public function getDistinctPrefixSep()
  {
    return $this->createFlatDistinct('codes', 'code_prefix_separator', 'code_prefix_separator')->execute();
  }

  /**
  * Get Distincts suffix separators
  * @return array an Array of types in keys
  */
  public function getDistinctSuffixSep()
  {
    return $this->createFlatDistinct('codes', 'code_suffix_separator', 'code_suffix_separator')->execute();
  }

  public function getCodesRelated($table='specimens', $specId = null)
  {
	return $this->getCodesRelatedArray($table, $specId);
  }

  /**
  * Get all codes related to an Array of id
  * @param string $table Name of the table referenced
  * @param array $specIds Array of id of related record
  * @return Doctrine_Collection Collection of codes
  */
  public function getCodesRelatedArray($table='specimens', $specIds = array())
  {
    if(!is_array($specIds))
      $specIds = array($specIds);
	if(empty($specIds)) return array();
    $q = Doctrine_Query::create()->
         from('Codes')->
         where('referenced_relation = ?', $table)->
         andWhereIn('record_id', $specIds)->
         orderBy('referenced_relation, record_id, code_category ASC, code_date DESC, full_code_order_by ASC');
    return $q->execute();
  }

}