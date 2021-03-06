<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SpecimenPartsTable extends DarwinTable
{
  protected static $widget_array = array(
    'specimen_part' => 'specPart' ,
    'complete' => 'complete' ,
    'specimen_status' => 'complete',      
    'building' => 'localisation' ,
    'floor' => 'localisation' ,
    'room' => 'localisation' ,
    'row' => 'localisation' ,
    'shelf' => 'localisation' ,
    'container' => 'container' ,
    'sub_container' => 'container' ,
    'container_type' => 'container',    
    'sub_container_type' => 'container',
    'container_storage' => 'container',
    'sub_container_storage' => 'container',
    'surnumerary' => 'container',            
    'specimen_individuals_count_min' => 'partCount' ,
    'specimen_individuals_count_min' => 'partCount' 
  );
  /**
  * Get Distincts Buildings of Part
  * @return array an Array of types in keys
  */
  public function getDistinctBuildings()
  {
    return $this->createFlatDistinct('specimen_parts', 'building', 'buildings')->execute();
  }

  /**
  * Get Distincts Floor of Part
  * @return array an Array of types in keys
  */
  public function getDistinctFloors($building = null)
  {
    if($building == null) return $this->createFlatDistinct('specimen_parts', 'floor', 'floors')->execute();
    $q = $this->createDistinct('SpecimenParts', 'floor', 'floors');
	if(! is_null($building))
	  $q->addWhere('building = ?', $building);
	return $q->execute();
  }

  /**
  * Get Distincts Room of Part
  * @return array an Array of types in keys
  */
  public function getDistinctRooms($building = null, $floor = null)
  {
    if($building == null && $floor == null) return $this->createFlatDistinct('specimen_parts', 'room', 'rooms')->execute();
    $q = $this->createDistinct('SpecimenParts', 'room', 'rooms');
	if(! is_null($building))
	  $q->addWhere('building = ?', $building);

	if(! is_null($floor))
	  $q->addWhere('floor = ?', $floor);

	return $q->execute();
  }

  /**
  * Get Distincts Row of Part
  * @return array an Array of types in keys
  */
  public function getDistinctRows($building = null, $floor = null, $room = null)
  {
    if($building == null && $floor == null && $room == null) return $this->createFlatDistinct('specimen_parts', 'row', 'rows')->execute();
    $q = $this->createDistinct('SpecimenParts', 'row', 'rows');
	if(! is_null($building))
	  $q->addWhere('building = ?', $building);

	if(! is_null($floor))
	  $q->addWhere('floor = ?', $floor);

	if(! is_null($room))
	  $q->addWhere('room = ?', $room);

	return $q->execute();
  }

  /**
  * Get Distincts Shelve of Part
  * @return array an Array of types in keys
  */
  public function getDistinctShelfs($building = null, $floor = null, $room = null, $rows = null)
  {
    if($building == null && $floor == null && $room == null && $rows == null) return $this->createFlatDistinct('specimen_parts', 'shelf', 'shelfs')->execute();
    $q = $this->createDistinct('SpecimenParts', 'shelf', 'shelfs');
	if(! is_null($building))
	  $q->addWhere('building = ?', $building);

	if(! is_null($floor))
	  $q->addWhere('floor = ?', $floor);

	if(! is_null($room))
	  $q->addWhere('room = ?', $room);

	if(! is_null($rows))
	  $q->addWhere('row = ?', $rows);
	return $q->execute();
  }

  /**
  * Get Distincts Container of Part
  * @return array an Array of types in keys
  */
  public function getDistinctContainerTypes()
  {
    $contTypes = $this->createFlatDistinct('specimen_parts', 'container_type', 'container_type')->execute();
    $contTypes->add(new SpecimenParts);
    return $contTypes;
  }

  /**
  * Get Distincts Sub Container of Part
  * @return array an Array of types in keys
  */
  public function getDistinctSubContainerTypes()
  {
    $subContTypes = $this->createFlatDistinct('specimen_parts', 'sub_container_type', 'sub_container_type')->execute();
    $subContTypes->add(new SpecimenParts);
    return $subContTypes;
  }

  /**
  * Get Distincts Sub Container of Part
  * @return array an Array of types in keys
  */
  public function getDistinctParts()
  {
    $parts = $this->createFlatDistinct('specimen_parts', 'specimen_part', 'specimen_part')->execute();
    $parts->add(new SpecimenParts);
    return $parts;
  }

  /**
  * Get Distincts status of Part
  * @return array an Array of types in keys
  */
  public function getDistinctStatus()
  {
    $statuses = $this->createFlatDistinct('specimen_parts', 'specimen_status', 'specimen_status')->execute();
    $statuses->add(new SpecimenParts);
    return $statuses;
  }

  /**
  * Get Distincts Container Storages of Part
  * filter by type if one given
  * @param string $type a type
  * @return array an Array of types in keys
  */
  public function getDistinctContainerStorages($type)
  {
    $q = $this->createDistinct('SpecimenParts INDEXBY storage', 'container_storage', 'storage','');
    if(! is_null($type))
      $q->addWhere('container_type = ?', $type);
    $results = $q->fetchArray();
    if(count($results))
      $results = array_combine(array_keys($results),array_keys($results));

    return array_merge(array('dry'=>'dry'), $results);
  }

  /**
  * Get Distincts Sub Container Storages of Part
  * filter by type if one given
  * @param string $type a type
  * @return array an Array of types in keys
  */
  public function getDistinctSubContainerStorages($type)
  {
	$q = $this->createDistinct('SpecimenParts INDEXBY storage', 'sub_container_storage', 'storage','');
	if(! is_null($type))
	  $q->addWhere('sub_container_type = ?', $type);
	$results = $q->fetchArray();
	if(count($results))
	  $results = array_combine(array_keys($results),array_keys($results));

	return array_merge(array('dry'=>'dry'), $results);
  }

  /**
  * Get all parts for an individual with some details info
  * @param int $individual Id of the individual
  * @return Doctrine_Collection of parts
  */
  public function findForIndividual($individual)
  {
	$q = Doctrine_Query::create()
		  ->from('SpecimenParts p')
      ->select('p.*, CONCAT(p.path,p.id,E\'/\') as spec_path_id')
		  ->andWhere('p.specimen_individual_ref = ?',$individual)
		  ->orderBy('spec_path_id ASC, p.specimen_part ASC, p.room ASC, p.row ASC, p.shelf ASC');
	return $q->execute();
  }
    
  /**
  * Set required widget visible and opened 
  */   
  public function getRequiredWidget($criterias, $user, $category,$all = 0)
  {
    if(!$all)
    {
      $req_widget = array() ;
      foreach($criterias as $key => $fields)
      {
        if ($key == "rec_per_page") continue ;
        if ($fields == "") continue ;

        if(isset(self::$widget_array[$key]))
          $req_widget[self::$widget_array[$key]] = 1 ;
      }
      Doctrine::getTable('MyWidgets')->forceWidgetOpened($user, $category ,array_keys($req_widget));
    }
    else
      Doctrine::getTable('MyWidgets')->forceWidgetOpened($user, $category ,1);
  }
}
