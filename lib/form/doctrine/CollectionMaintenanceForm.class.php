<?php

/**
 * CollectionMaintenance form.
 *
 * @package    form
 * @subpackage CollectionMaintenance
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class CollectionMaintenanceForm extends BaseCollectionMaintenanceForm
{
  public function configure()
  {
	$this->useFields(array('id','people_ref', 'category', 'action_observation', 'description','modification_date_time'));

    $yearsKeyVal = range(intval(sfConfig::get('app_yearRangeMin')), intval(sfConfig::get('app_yearRangeMax')));
    $years = array_combine($yearsKeyVal, $yearsKeyVal);
    $minDate = new FuzzyDateTime(strval(min($yearsKeyVal)).'/1/1 0:0:0');
    $maxDate = new FuzzyDateTime(strval(max($yearsKeyVal)).'/12/31 23:59:59');
    $dateLowerBound = new FuzzyDateTime(sfConfig::get('app_dateLowerBound'));
    $dateUpperBound = new FuzzyDateTime(sfConfig::get('app_dateUpperBound'));

	$this->widgetSchema['modification_date_time'] = new widgetFormJQueryFuzzyDate(array('culture'=>$this->getCurrentCulture(), 
		'image'=>'/images/calendar.gif', 
		'format' => '%day%/%month%/%year%', 
		'years' => $years,
		'with_time' => true
	  ),
	  array('class' => 'from_date')
	  );


    $this->validatorSchema['modification_date_time'] = new fuzzyDateValidator(array(
      'required' => false,
      'from_date' => true,
      'min' => $minDate,
      'max' => $maxDate,
      'empty_value' => $dateLowerBound,
      'with_time' => true
	  ),
	  array('invalid' => 'Invalid date "from"')
    );

	$this->widgetSchema['people_ref'] = new widgetFormButtonRef(array(
	  'model' => 'People',
	  'method' => 'getFormatedName',
	  'link_url' => 'people/choose',
	  'nullable' => false,
	  'box_title' => $this->getI18N()->__('Choose Yourself'),
	));

	$this->widgetSchema['parts_ids'] = new sfWidgetFormInputHidden();
	$this->validatorSchema['parts_ids'] = new sfValidatorString(array('required' => false, 'empty_value' => ''));

	$this->widgetSchema['category'] = new sfWidgetFormChoice(array('choices' => array('action' => 'Action', 'observation'=>'Observation')));
	$this->widgetSchema['category']->setLabel('Type');
	$this->widgetSchema['action_observation']->setLabel('Maintenance Achieved');
	$this->widgetSchema['action_observation'] = new widgetFormSelectComplete(array(
	  'model' => 'CollectionMaintenance',
	  'table_method' => 'getDistinctActions',
	  'method' => 'getAction',
	  'key_method' => 'getAction',
	  'add_empty' => false,
	  'change_label' => 'Pick an action in the list',
	  'add_label' => 'Add another action',
    ));
  }
}