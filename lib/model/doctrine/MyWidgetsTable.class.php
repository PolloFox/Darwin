<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class MyWidgetsTable extends DarwinTable
{
  
  public function getWidget($userId, $widget, $category)
  {
    $q = Doctrine_Query::create()
         ->from('MyWidgets p')
         ->andWhere('p.user_ref = ?', $userId)
         ->andWhere('p.category = ?', $category)
         ->andWhere('p.group_name = ?', $widget)
         ->andWhere('p.is_available = true') ;
    return $q->fetchOne();
  }

  public function getWidgets($category, $collection = null)
  {
      $q = Doctrine_Query::create()
            ->from('MyWidgets p INDEXBY p.group_name')
            ->orderBy('p.col_num ASC, p.order_by ASC, p.group_name ASC');                
    return $this->addCategoryUser($q,$category,$collection)->execute();
  }
  
  public function setUserRef($ref)
  {
    $this->user_ref = $ref;
    return $this;
  }
  
  public function setDbUserType($ref)
  {
    $this->db_user_type = $ref;
    return $this;
  }
  public function getDbUserType()
  {
    return $this->db_user_type;
  }
    
  public function changeWidgetStatus($category, $widget, $status)
  {
    $q = Doctrine_Query::create()
         ->update('MyWidgets p');
    if($status == "open" || $status == "close")
    {
        $q->set('p.opened', $status=="open" ? 'true' : 'false' );
    }
    elseif($status == "visible")
    {
        $q->set('p.visible', 'true');
        $q->set('p.opened', 'true');

        $q2 = Doctrine_Query::create()
              ->select('MIN(p.order_by) as ord')
              ->from('MyWidgets p')
              ->andWhere('p.visible=?','true');

        $this->addCategoryUser($q2,$category);
        $result = $q2->execute()->getFirst();
        $q->set('p.order_by', (isset($result['ord'])) ? $result['ord']-1 : 1);
    }
    elseif($status == "hidden")
    {
        $q->set('p.visible', 'false');
    }

    $this->addCategoryUser($q,$category)
        ->andWhere('p.group_name = ?',$widget);
    return $q->execute();
  }

  public function changeOrder($category, $col1, $col2)
  {
    $this->updateWidgetsOrder($col1, 1, $category);
    $this->updateWidgetsOrder($col2, 2, $category);
  }
  

  /**
  * set or unset the availability of widgets for a user and a role
  * @param string $role Group of widget for which the availability must be updated
  * @param boolean $availability Is the $role must be set as available or not
  */
  public function updateWigetsAvailabilityForRole($role, $availability)
  {
	  $file = MyWidgets::getFileByRight($role) ;
	  if($file)
	  {
		  $data = new Doctrine_Parser_Yml();
		  $array = $data->loadData($file);
		  $q = Doctrine_Query::create()
		    ->update('MyWidgets p') 
		    ->set('p.is_available','?', $availability) 
		    ->where('p.user_ref = ?', $this->user_ref) ;
		  $list_group_name = array() ;
		  foreach ($array as $widget => $array_values) 
                   $list_group_name[] = $array_values['group_name'] ;
		  $q->wherein('p.group_name',$list_group_name)
		    ->execute() ;	
	  }  	
  }

  public function addCategoryUser(Doctrine_Query $q = null, $category, $collection = null)
  {
    if (sfConfig::get('sf_logging_enabled') && !$this->user_ref)
    {
     sfContext::getInstance()->getLogger()->warning("No User defined with setUserRef");
      throw new Exception('No User defined for query');
    }
    if (is_null($q))
    {
        $q = Doctrine_Query::create()
            ->from('MyWidgets p');
    }

    $alias = $q->getRootAlias();

    $q->andWhere($alias . '.user_ref = ?', $this->user_ref)
        ->andWhere($alias . '.category = ?', $category)
        ->andWhere('p.is_available = true') ;
    if ($this->db_user_type == Users::REGISTERED_USER) 
    {
      if($collection != null) $q->andWhere('p.all_public = true OR p.collections like \'%,'.$collection.',%\'') ;
      else $q->andWhere('p.all_public = true') ; 
    }
    return $q;
  }
 
  public function getWidgetsList($level, $is_reg_user = false)
  {
  	$q = Doctrine_Query::create()
            ->from('MyWidgets p')
  		  ->where('p.user_ref = ?', $this->user_ref) ;
     if ($level < Users::MANAGER) $q->andWhere('p.is_available = true') ;
     if ($is_reg_user) $q->andWhere('p.all_public = true') ;
     $q->orderBy('category,group_name');
   	return $q->execute() ;	
  }
 
  public function getAvailableWidgets()
  {
    $categories = array('specimen_widget','individuals_widget','part_widget');
	  $q = Doctrine_Query::create()
	    ->from('MyWidgets p')
	    ->andWhere('p.all_public = false') 
	    ->andwhere('p.user_ref = ?', $this->user_ref) 
	    ->andWhereIn("p.category",$categories) 
	    ->orderBy('category DESC,group_name ASC');	  
	  return $q->execute() ;
  }

  /**
  * Change the order of widgets in a screen column for a user_id
  * @param array $widget_array An array of ids of widgets ordered
  * @param int $col_num the number of the column
  * @param string $category Screen's category name
  * @see setUserRef
  */
  public function updateWidgetsOrder($widget_array, $col_num, $category)
  {
    if(! is_array($widget_array))
        throw new Exception ('Widgets must be an array');
    $q = Doctrine_Query::create()
          ->update('MyWidgets p')
          ->set('p.col_num','?',$col_num)
          ->set('p.order_by',"fct_array_find(?,group_name::text) ",implode(",",$widget_array))
          ->andWhereIn('p.group_name',$widget_array);

    $this->addCategoryUser($q,$category)->execute();
  }
  
  /**
  * Set all widget saved in a MySavedSearch visible in order see all parameter
  * @param string $user user for witch widget to be updated
  * @param string $category category widget to upgate (ex : specimensearch)
  * @parem array $widget_array list of widgets witch status 'opened' is required
  */
  public function forceWidgetOpened($user, $category,$widget_array)
  {
    if(empty($widget_array)) return;
    $q = Doctrine_Query::create()
          ->update('MyWidgets p')
          ->set('p.visible','true')
          ->set('p.opened','true')
          ->where('p.user_ref = ?',$user)
          ->andWhere('category = ?',$category);
    if (is_array($widget_array)) 
      $q->andWhereIn('p.group_name',$widget_array);
    return $q->execute() ;
  }

  public function incrementOrder($user_id, $category, $col_num, $position)
  {
    $q = Doctrine_Query::create()
      ->update('MyWidgets p')
      ->where('p.user_ref = ?',$user_id)
      ->andWhere('category = ?',$category)
      ->andWhere('p.is_available = true')
      ->andWhere('p.col_num = ?', $col_num)
      ->andWhere('p.order_by > ?', $position)
      ->set('p.order_by','p.order_by+1');
    return $q->execute() ;
  }
  
  /**
  * function called by WidgetRightform to add a specific collection_ref to a list of widget
  * @param string $collection_ref collection to be added in collections field
  * @param array $list_id list of widgets id witch where $collection_ref has to be inserted
  * @param string $mode used to dtermine if the query is for adding a collection_ref or removing it
  */  
  public function doUpdateWidgetRight($collection_ref,$list_id=null, $mode=null)
  {
    $conn = Doctrine_Manager::connection();
    $q = "UPDATE my_widgets " ;
    if($mode == 'insert') 
      $q .= "SET collections= collections || '$collection_ref,' " ;      
    else
      $q .= "SET collections = regexp_replace(collections, E'\,$collection_ref\,', E'\,', 'g') " ;
    if($list_id ==null)
      $q .= "WHERE user_ref = ".$this->user_ref ;    
    else
      $q .= "WHERE (id in (".implode(',',$list_id).") AND user_ref = ".$this->user_ref.")" ;  
    $result = $conn->fetchAssoc($q);  
    $conn->close() ; 
  }
 
}
