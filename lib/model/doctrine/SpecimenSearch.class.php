<?php

/**
 * SpecimenSearch
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    darwin
 * @subpackage model
 * @author     DB team <collections@naturalsciences.be>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class SpecimenSearch extends BaseSpecimenSearch
{

    public function getCountryTags($is_view = false)
    {
      $tags = explode(';',$this->getGtuCountryTagValue(''));
      $nbr = count($tags);
      if(! $nbr) return "-";
      $str = '<ul class="name_tags_view">';
      foreach($tags as $value)
        if (strlen($value))
          $str .=  '<li>' . trim($value).'</li>';
      $str .= '</ul>';
      
      return $str;
    }

    public function getOtherGtuTags()
    {
      $tags = explode(';',$this->getGtuCountryTagValue(''));
      $nbr = count($tags);
      if(! $nbr) return "-";
      $str = '<ul class="name_tags_view">';
      foreach($tags as $value)
        if (strlen($value))
          $str .=  '<li>' . trim($value).'</li>';
      $str .= '</ul>';
      
      return $str;
    }

  public function getAcquisitionDateMasked ()
  {
    $dateTime = new FuzzyDateTime($this->_get('acquisition_date'), $this->_get('acquisition_date_mask'));
    return $dateTime->getDateMasked();
  }


  public function getAggregatedName($sep = ' / ')
  {
    $items = array(
        $this->getCollectionName(),
        $this->getTaxonName(),
        $this->getChronoName(),
        $this->getLithoName(),
        $this->getLithologyName(),
        $this->getMineralName()
   );

    $items = array_filter($items);
    return implode($sep, $items);
  } 

  /* function witch check if there at least 1 common name for a specific specimen */
  public function checkCommonNameForSpecimen($common_name,$spec) 
  {
    $bool = false ;
    if(Individualsearch::checkIfCommonName($spec->getTaxonRef(), $common_name['taxonomy'])) $bool = true ;
    if(Individualsearch::checkIfCommonName($spec->getChronoRef(), $common_name['chronostratigraphy'])) $bool = true ;
    if(Individualsearch::checkIfCommonName($spec->getLithoRef(), $common_name['lithostratigraphy'])) $bool = true ;
    if(Individualsearch::checkIfCommonName($spec->getLithologyRef(), $common_name['lithology'])) $bool = true ;
    if(Individualsearch::checkIfCommonName($spec->getMineralRef(), $common_name['mineralogy'])) $bool = true ;   
    return $bool ;             
  }

}
