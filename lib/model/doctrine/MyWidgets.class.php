<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class MyWidgets extends BaseMyWidgets
{
  /**
  * Get Widget list file for a given role
  * @param int $role The Role of the user
  * @see Users
  */
  public static function getFileByRight($role)
  {
    $file=sfConfig::get('sf_data_dir').'/widgets/' ;
    switch ($role) {
      case Users::ENCODER : $file .='encoderWidgetListPerScreen.yml' ; break ;
      case Users::MANAGER : $file .='collManagerWidgetListPerScreen.yml' ; break ;
      case Users::REGISTERED_USER : $file .='regUserWidgetListPerScreen.yml' ; break ;
      default : return(0);
    }
    return($file) ;
  }

  public function getWidgetField()
  {
    if ($this->getMandatory()) return('opened') ;
    if (!$this->getIsAvailable()) return ('unused') ;
    if ($this->getOpened()) return('opened') ;
    if ($this->getVisible()) return('visible') ;
    if ($this->getIsAvailable()) return('is_available') ;
  }

  public function getWidgetChoice()
  {
    return $this->getWidgetField() ;
  }

  public function setWidgetChoice($value)
  {
    $values_array = array('opened' => false, 'visible' => false, 'is_available' => false);

    if ($this->getMandatory()) $values_array = array_fill_keys(array_keys($values_array), true);
    if ($value == 'opened') $values_array = array_fill_keys(array_keys($values_array), true);
    if ($value == 'is_available') $values_array['is_available'] = true;
    if ($value == 'visible')
    {
      $values_array['visible'] = true;
      $values_array['is_available'] = true;
    }

    foreach($values_array as $key => $new_value)
    {
      if($this[$key] != $new_value)
        $this[$key] = $new_value;
    }
  }

  public function getComponentFromCategory()
  {
    $cat_array = explode('_',$this->_get('category'));
    return $cat_array[0].'widget';
  }

  public function getTableFromCategory()
  {
    $cat_array = explode('_', $this->_get('category'));
    if(count($cat_array) == 2)
      return $cat_array[1];
    return null;
  }
}
