<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PeopleComm extends BasePeopleComm
{
  /**
  * Get tags of the comm as an array (only label not keys)
  * @return array Array of tags for this comm
  */
  public function getTagsAsArray()
  {
    $array = explode(',',$this->_get('tag'));
    $result = array();
    $possible_tags = Doctrine::getTable('PeopleComm')->getTags($this->_get('comm_type'));
    foreach($array as $tag)
    {
      $tag=trim($tag);
      if(isset($possible_tags[$tag]))
	$result[] = $possible_tags[$tag];
    }
    return $result;
  }
}