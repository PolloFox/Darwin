<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) Jonathan H. Wage <jonwage@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetDarwinList represents a choice widget for a model.
 *
 * @package    symfony
 * @subpackage doctrine
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: sfWidgetFormDoctrineChoice.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
 
class sfWidgetCollectionList extends sfWidgetFormChoice
{
  public function configure($options = array(),$attributes = array())
  {
    parent::configure($options, $attributes);  
    $this->addOption('multiple', true);
    $this->addOption('extended', true);        
  }
  
  public function getChoices()
  { 
    $parent = $this->getOption('collection_parent');
    $choices = array() ;    
    if ($parent)
    {
      $objects = Doctrine_Core::getTable('Collections')->fetchByCollectionParent($parent);
    }
    else      
      $objects = Doctrine_Core::getTable('Collections')->getAllCollectionsId() ;
    foreach ($objects as $object)
    {
      $choices[$object->getId()] = array() ;
      $choices[$object->getId()]['level'] = substr_count($object->getPath(),'/') ;
      $choices[$object->getId()]['label'] = $object->getName() ;    
    }      
    if($this->getOption('listCheck'))
    {
      foreach ($this->getOption('listCheck') as $list)
      {
        $choices[$list]['checked'] = 1 ;
      }
    } 
    elseif ($parent)
    {
      foreach ($this->getOption('old_right') as $list)
      {
        if ($list != $parent)
          $choices[$list]['checked'] = 1 ;
      }
    }     
    return $choices;
  }
  
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    if ($this->getOption('multiple'))
    {
      $attributes['multiple'] = 'multiple';

      if ('[]' != substr($name, -2))
      {
        $name .= '[]';
      }
    }   
    $options = array();
    $this->addOption('listCheck',$value) ; 
    $choices = $this->getChoices();
    $html = "" ;
    $prev_level = 0 ;
    if(count($choices) == 0) return ('No existing Sub collections');
    if($this->hasOption('collection_parent'))
    {
      $img_expand = 'individual_expand.png';
      $img_expand_up = 'individual_expand.png' ;
    }
    else
    {
      $img_expand = 'blue_expand.png';
      $img_expand_up = 'blue_expand.png' ;
    }    
    foreach ($choices as $key => $option)
    {    
        if($prev_level < $option['level'])
          $html .= "<ul>\n" ;
        else
        {
          $html .= "</li>\n" ;
          if($prev_level > $option['level'])
              $html .= str_repeat('</ul></li>',$prev_level-$option['level']);
        }
        $html .= "<li class=\"rid_".$key."\"><div class=\"col_name\">" ;
        $html .= image_tag ($img_expand, array('alt' => '+', 'class'=> 'tree_cmd collapsed'));
        $html .= image_tag ($img_expand_up, array('alt' => '-', 'class'=> 'tree_cmd expanded'));
        $html .=  "<span>".$option['label'];
			  $html .= "<div class=\"check_right\">\n\t\t" ;
        $html .= "<input type=\"checkbox\" value=\"".$key."\" name=\"".$name."\"" ;
        if(isset($option['checked'])) $html .= "checked=\"".$option['checked']."\"" ;
		    $html .= "></div></span></div>" ;
        $prev_level = $option['level'] ;
    }
    $html .= str_repeat('</li></ul>',$option['level']);    
    $html .= "</div><div class=\"check_right\">";
	  if ($this->hasOption('collection_parent'))
	  {
      $html .= "<input id=\"reset\" type=\"reset\" value=\"Reset\" />" ;
      $html .= "<input id=\"submit\" type=\"submit\" value=\"".__('Save')."\" />" ;
    }
    else $html .= "<input type=\"button\" class=\"result_choose\" value=\"clear\" id=\"clear_collections\">" ;
    return($html) ;
  }
}
