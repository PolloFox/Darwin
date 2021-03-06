<?php

/**
 * Insurances
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    darwin
 * @subpackage model
 * @author     DB team <collections@naturalsciences.be>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class Insurances extends BaseInsurances
{
  /**
  * Get the formated Insurance value
  * @return string the value formated with currency
  */
  public function getFormatedInsuranceValue()
  {
    $insuranceValue = $this->_get('insurance_value').' '.$this->_get('insurance_currency');
    return $insuranceValue;
  }
  
  /**
  * Get the formated value reference year
  * @return string the year formated
  */
  public function getFormatedInsuranceYear()
  {
    $insuranceYear = $this->_get('insurance_year');
    if ($insuranceYear == 0)
    {
      $insuranceYear = '-';
    }
    return $insuranceYear;
  }
  
}
