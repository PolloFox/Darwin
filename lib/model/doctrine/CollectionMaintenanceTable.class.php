<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CollectionMaintenanceTable extends DarwinTable
{
  public function getDistinctActions()
  {
    return $this->createDistinct('CollectionMaintenance', 'action_observation', 'action')->execute();
  }
  
  /**
  * Get Number of maintenances for an array of records
  * @param $table Referenced relation
  * @param $ids array of ids
  * @return array with count and record_id in keys
  */
  public function getCountRelated($table, $ids)
  {
    $q = Doctrine_Query::create()->
 		select('COUNT(m.id) AS cnt, m.record_id')->
		from('CollectionMaintenance m')->
		where('m.referenced_relation = ?', $table)->
		andWhereIn('m.record_id', $ids)->
		groupBy('m.record_id');
    return $q->execute(array(), Doctrine_Core::HYDRATE_NONE);
  }

  /**
  * Get Related maintenances for a record
  * @param table the referenced relation
  * @param $ids array of refereced id
  * @return Doctrine_Collection of Maintenances
  */
  public function getRelatedArray($table, $ids = array())
  {
    if(!is_array($ids))
      $ids = array($ids);
	if(empty($ids)) return array();
    $q = Doctrine_Query::create()->
         from('CollectionMaintenance m')->
		 innerJoin('m.People')->
         where('referenced_relation = ?', $table)->
         andWhereIn('record_id', $ids)->
         orderBy('record_id ASC, modification_date_time DESC, id ASC');
    return $q->execute();
  }
}