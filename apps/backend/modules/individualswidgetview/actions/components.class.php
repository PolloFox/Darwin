<?php

/**
 * specimen individuals components actions.
 *
 * @package    darwin
 * @subpackage individuals_widget
 * @author     DB team <collections@naturalsciences.be>
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class individualswidgetViewComponents extends sfComponents
{

  protected function defineForm()
  {
    $this->indiv = Doctrine::getTable('SpecimenSearch')->findOneByIndividualRef($this->eid);
  }

  public function executeType()
  {
    $this->defineForm();
  }

  public function executeSex()
  {
    $this->defineForm();
  }

  public function executeStage()
  {
    $this->defineForm();
  }

  public function executeSocialStatus()
  {
    $this->defineForm();
  }

  public function executeRockForm()
  {
    $this->defineForm();
  }

  public function executeSpecimenIndividualCount()
  {
    $this->defineForm();
    if ($this->indiv->getIndividualCountMin() === $this->indiv->getIndividualCountMax()) $this->accuracy = "Exact" ;
    else $this->accuracy = "Imprecise" ;
  }

  public function executeSpecimenIndividualComments()
  {
    $this->Comments = Doctrine::getTable('Comments')->findForTable('specimen_individuals',$this->eid) ;
  }
  
  public function executeRefIdentifications()
  {
    $this->identifications = Doctrine::getTable('Identifications')->getIdentificationsRelated('specimen_individuals',$this->eid) ;
    $this->people = array() ;
    foreach ($this->identifications as $key=>$val)
    {
      $Identifier = Doctrine::getTable('CataloguePeople')->getPeopleRelated('identifications', 'identifier', $val->getId()) ;
      $this->people[$val->getId()] = array();
      foreach ($Identifier as $key2=>$val2)
      {
        $this->people[$val->getId()][] = $val2->People->getFormatedName() ;
      }
    } 
  }

  public function executeRefProperties()
  {
  }
  
  public function executeExtLinks()
  {}
}
