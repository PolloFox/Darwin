<?php

/**
 * Tags form base class.
 *
 * @method Tags getObject() Returns the current form's model object
 *
 * @package    darwin
 * @subpackage form
 * @author     DB team <collections@naturalsciences.be>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTagsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'gtu_ref'           => new sfWidgetFormInputHidden(),
      'group_ref'         => new sfWidgetFormInputHidden(),
      'tag_value_indexed' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'gtu_ref'           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'gtu_ref', 'required' => false)),
      'group_ref'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'group_ref', 'required' => false)),
      'tag_value_indexed' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'tag_value_indexed', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tags[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tags';
  }

}
