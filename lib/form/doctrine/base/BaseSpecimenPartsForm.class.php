<?php

/**
 * SpecimenParts form base class.
 *
 * @method SpecimenParts getObject() Returns the current form's model object
 *
 * @package    darwin
 * @subpackage form
 * @author     DB team <collections@naturalsciences.be>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseSpecimenPartsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'specimen_individual_ref' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Individual'), 'add_empty' => false)),
      'specimen_part'           => new sfWidgetFormTextarea(),
      'complete'                => new sfWidgetFormInputCheckbox(),
      'building'                => new sfWidgetFormTextarea(),
      'floor'                   => new sfWidgetFormTextarea(),
      'room'                    => new sfWidgetFormTextarea(),
      'row'                     => new sfWidgetFormTextarea(),
      'shelf'                   => new sfWidgetFormTextarea(),
      'container'               => new sfWidgetFormTextarea(),
      'sub_container'           => new sfWidgetFormTextarea(),
      'container_type'          => new sfWidgetFormTextarea(),
      'sub_container_type'      => new sfWidgetFormTextarea(),
      'container_storage'       => new sfWidgetFormTextarea(),
      'sub_container_storage'   => new sfWidgetFormTextarea(),
      'surnumerary'             => new sfWidgetFormInputCheckbox(),
      'specimen_status'         => new sfWidgetFormTextarea(),
      'specimen_part_count_min' => new sfWidgetFormInputText(),
      'specimen_part_count_max' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'specimen_individual_ref' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Individual'))),
      'specimen_part'           => new sfValidatorString(array('required' => false)),
      'complete'                => new sfValidatorBoolean(array('required' => false)),
      'building'                => new sfValidatorString(array('required' => false)),
      'floor'                   => new sfValidatorString(array('required' => false)),
      'room'                    => new sfValidatorString(array('required' => false)),
      'row'                     => new sfValidatorString(array('required' => false)),
      'shelf'                   => new sfValidatorString(array('required' => false)),
      'container'               => new sfValidatorString(array('required' => false)),
      'sub_container'           => new sfValidatorString(array('required' => false)),
      'container_type'          => new sfValidatorString(array('required' => false)),
      'sub_container_type'      => new sfValidatorString(array('required' => false)),
      'container_storage'       => new sfValidatorString(array('required' => false)),
      'sub_container_storage'   => new sfValidatorString(array('required' => false)),
      'surnumerary'             => new sfValidatorBoolean(array('required' => false)),
      'specimen_status'         => new sfValidatorString(array('required' => false)),
      'specimen_part_count_min' => new sfValidatorInteger(array('required' => false)),
      'specimen_part_count_max' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('specimen_parts[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SpecimenParts';
  }

}
