<?php

/**
 * Institution form.
 *
 * @package    darwin
 * @subpackage form
 * @author     DB team <collections@naturalsciences.be>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InstitutionsForm extends BaseInstitutionsForm
{
  public function configure()
  {
    unset($this['formated_name_indexed'], $this['formated_name_ts']);
    $this->widgetSchema['is_physical'] = new sfWidgetFormInputHidden();
    $this->setDefault('is_physical', 'off');
    $this->widgetSchema['additional_names'] = new sfWidgetFormInput();
    $this->widgetSchema['sub_type'] = new widgetFormSelectComplete(array(
        'model' => 'Institutions',
        'table_method' => 'getDistinctSubType',
        'method' => 'getType',
        'key_method' => 'getType',
        'add_empty' => true,
	'change_label' => 'Pick a type in the list',
	'add_label' => 'Add another type',
    ));

    $this->widgetSchema['db_people_type'] = new sfWidgetFormChoice(array(
      'choices'        => Institutions::getTypes(),
      'expanded'       => true,
      'multiple'       => true
    ));
    $this->widgetSchema['db_people_type']->setLabel('Role');
    $this->widgetSchema['sub_type']->setLabel('Type');
    $this->validatorSchema['db_people_type'] = new sfValidatorChoice(array('choices' => array_keys(Institutions::getTypes()), 'required' => false, 'multiple' => true));

    $this->widgetSchema['additional_names']->setAttributes(array('class'=>'small_size'));
  }
}
