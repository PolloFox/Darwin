<?php

/**
 * Codes filter form base class.
 *
 * @package    darwin
 * @subpackage filter
 * @author     DB team <collections@naturalsciences.be>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCodesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'referenced_relation' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'record_id'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'code_category'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'code_prefix'         => new sfWidgetFormFilterInput(),
      'code'                => new sfWidgetFormFilterInput(),
      'code_suffix'         => new sfWidgetFormFilterInput(),
      'full_code_indexed'   => new sfWidgetFormFilterInput(),
      'code_date'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'referenced_relation' => new sfValidatorPass(array('required' => false)),
      'record_id'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'code_category'       => new sfValidatorPass(array('required' => false)),
      'code_prefix'         => new sfValidatorPass(array('required' => false)),
      'code'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'code_suffix'         => new sfValidatorPass(array('required' => false)),
      'full_code_indexed'   => new sfValidatorPass(array('required' => false)),
      'code_date'           => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('codes_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Codes';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'referenced_relation' => 'Text',
      'record_id'           => 'Number',
      'code_category'       => 'Text',
      'code_prefix'         => 'Text',
      'code'                => 'Number',
      'code_suffix'         => 'Text',
      'full_code_indexed'   => 'Text',
      'code_date'           => 'Text',
    );
  }
}