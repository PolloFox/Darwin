<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CataloguePropertiesTable extends DarwinTable
{
  /**
  * Find a property (joined with values)
  * for a given table and record id
  * @param string $table_name db table name
  * @param int $record_id id of the record
  * @return a Doctrine_collection of results
  */
  public function findForTable($table_name, $record_id)
  {
     $q = Doctrine_Query::create()
	 ->from('CatalogueProperties p')
	 ->leftJoin('p.PropertiesValues v')
	 ->orderBy('p.property_type ASC');
     $q = $this->addCatalogueReferences($q, $table_name, $record_id, 'p', true);
     return $q->execute();
  }

  /**
  * Get Distincts type of properties
  * @return array an Array of types in keys
  */
  public function getDistinctType($ref_relation=null)
  {
    $q = $this->createDistinct('CatalogueProperties', 'property_type', 'type');
    if(! is_null($ref_relation))
      $q->addWhere('referenced_relation = ?', $ref_relation) ;
    return $q->execute() ;
  }

  /**
  * Get Distincts Sub Type of properties
  * filter by type if one given
  * @param string $type a type
  * @return array an Array of sub-types in keys/values
  */
  public function getDistinctSubType($type=null)
  {
    $q = $this->createDistinct('CatalogueProperties INDEXBY sub_type', 'property_sub_type', 'sub_type','');
    if(! is_null($type))
      $q->addWhere('property_type = ?',$type);
    $results = $q->fetchArray();
    if(count($results))
      $results = array_combine(array_keys($results),array_keys($results));
    return array_merge(array(''=>''), $results);
  }

  /**
  * Get Distincts Qualifier of properties
  * filter by sub type if one given
  * @param string $sub_type a type
  * @return array an Array of Qualifier in keys/values
  */
  public function getDistinctQualifier($sub_type=null)
  {
    $q = $this->createDistinct('CatalogueProperties', 'property_qualifier', 'qualifier','');

    if(! is_null($sub_type))
      $q->addWhere('property_sub_type_indexed = fullToIndex(?)',$sub_type);
    $results = $q->fetchArray();
    $rez=array(''=>''); //@TODO: don't know why but doctrine doesnt like it otherwise
    foreach($results as $item)
      $rez[$item['qualifier']]=$item['qualifier'];
    return $rez;
  }
  
  /**
  * Get Distincts units (accuracy + normal) of properties
  * filter by type if one given
  * @param string $type a type
  * @return array an Array of Qualifier in keys/values
  */
  public function getDistinctUnit($type=null)
  {
    $q = $this->createDistinct('CatalogueProperties INDEXBY unit', 'property_unit', 'unit','');

    if(! is_null($type))
      $q->addWhere('property_type = ?',$type);
    $q->andWhere('property_unit is not null');
    $results_unit = $q->fetchArray();

    $q = $this->createDistinct('CatalogueProperties INDEXBY unit', 'property_accuracy_unit', 'unit','');

    if(! is_null($type))
      $q->addWhere('property_type = ?',$type);
    $q->andWhere('property_accuracy_unit is not null');
    $results_accuracy = $q->fetchArray();
    $results = array_merge($results_unit, $results_accuracy);
  
    if(count($results))
      $results = array_combine(array_keys($results),array_keys($results));
    return array_merge(array(''=>'unit'), $results);
  }
}
