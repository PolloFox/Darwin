<?php

/**
 * SpecimenIndividuals form.
 *
 * @package    form
 * @subpackage SpecimenIndividuals
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class SpecimenIndividualsForm extends BaseSpecimenIndividualsForm
{
  public function configure()
  { 
    unset($this['type_group'], $this['type_search'], $this['id'], $this['with_parts']);
    $this->widgetSchema['specimen_ref'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['type'] = new widgetFormSelectComplete(array(
        'model' => 'SpecimenIndividuals',
        'table_method' => 'getDistinctTypes',
        'method' => 'getType',
        'key_method' => 'getType',
        'add_empty' => false,
        'change_label' => 'Pick a type in the list',
        'add_label' => 'Add an other type',
    ));
    $this->widgetSchema['sex'] = new widgetFormSelectComplete(array(
        'model' => 'SpecimenIndividuals',
        'table_method' => 'getDistinctSexes',
        'method' => 'getSex',
        'key_method' => 'getSex',
        'add_empty' => false,
        'change_label' => 'Pick a sex in the list',
        'add_label' => 'Add an other sex',
    ));
    $this->widgetSchema['state'] = new widgetFormSelectComplete(array(
        'model' => 'SpecimenIndividuals',
        'table_method' => 'getDistinctStates',
        'method' => 'getState',
        'key_method' => 'getState',
        'add_empty' => false,
        'change_label' => 'Pick a "sexual" state in the list',
        'add_label' => 'Add an other "sexual" state',
    ));
    $this->widgetSchema['stage'] = new widgetFormSelectComplete(array(
        'model' => 'SpecimenIndividuals',
        'table_method' => 'getDistinctStages',
        'method' => 'getStage',
        'key_method' => 'getStage',
        'add_empty' => false,
        'change_label' => 'Pick a stage in the list',
        'add_label' => 'Add an other stage',
    ));
    $this->widgetSchema['social_status'] = new widgetFormSelectComplete(array(
        'model' => 'SpecimenIndividuals',
        'table_method' => 'getDistinctSocialStatuses',
        'method' => 'getSocialStatus',
        'key_method' => 'getSocialStatus',
        'add_empty' => false,
        'change_label' => 'Pick a social status in the list',
        'add_label' => 'Add an other social status',
    ));
    $this->widgetSchema['rock_form'] = new widgetFormSelectComplete(array(
        'model' => 'SpecimenIndividuals',
        'table_method' => 'getDistinctRockForms',
        'method' => 'getRockForm',
        'key_method' => 'getRockForm',
        'add_empty' => false,
        'change_label' => 'Pick a rock form in the list',
        'add_label' => 'Add another rock form',
    ));

    $this->widgetSchema['accuracy'] = new sfWidgetFormChoice(array(
        'choices'  => array($this->getI18N()->__('exact'), $this->getI18N()->__('imprecise')),
        'expanded' => true,
    ));

    $this->setDefault('accuracy', 1);
    $this->widgetSchema['accuracy']->setLabel('Accuracy');

    $this->widgetSchema['ident'] = new sfWidgetFormInputHidden(array('default'=>1));

    $this->widgetSchema['comment'] = new sfWidgetFormInputHidden(array('default'=>1));

    $this->widgetSchema['extlink'] = new sfWidgetFormInputHidden(array('default'=>1));
    $this->validatorSchema['extlink'] = new sfValidatorPass();
    /* Validators */

    $this->validatorSchema['specimen_ref'] = new sfValidatorInteger(array('required'=>false));
    $this->validatorSchema['type'] = new sfValidatorString(array('trim'=>true, 'required'=>false, 'empty_value'=>$this->getDefault('type')));
    $this->validatorSchema['sex'] = new sfValidatorString(array('trim'=>true, 'required'=>false, 'empty_value'=>$this->getDefault('sex')));
    $this->validatorSchema['stage'] = new sfValidatorString(array('trim'=>true, 'required'=>false, 'empty_value'=>$this->getDefault('stage')));
    $this->validatorSchema['state'] = new sfValidatorString(array('trim'=>true, 'required'=>false, 'empty_value'=>$this->getDefault('state')));
    $this->validatorSchema['social_status'] = new sfValidatorString(array('trim'=>true, 'required'=>false, 'empty_value'=>$this->getDefault('social_status')));
    $this->validatorSchema['rock_form'] = new sfValidatorString(array('trim'=>true, 'required'=>false, 'empty_value'=>$this->getDefault('rock_form')));
    $this->validatorSchema['accuracy'] = new sfValidatorChoice(array(
        'choices' => array(0,1),
        'required' => false,
        ));
    $this->validatorSchema->setPostValidator(
        new sfValidatorSchemaCompare('specimen_individuals_count_min', '<=', 'specimen_individuals_count_max',
            array(),
            array('invalid' => 'The min number ("%left_field%") must be lower or equal the max number ("%right_field%")' )
            )
        );

    $this->validatorSchema['ident'] = new sfValidatorPass();
    $this->validatorSchema['comment'] = new sfValidatorPass();
  }

  public function loadEmbedIndentifications()
  {
    if($this->isBound()) return;

    /* Identifications sub form */
    $subForm = new sfForm();
    $this->embedForm('Identifications',$subForm);
    if($this->getObject()->getId() !='')
    {
      foreach(Doctrine::getTable('Identifications')->getIdentificationsRelated('specimen_individuals', $this->getObject()->getId()) as $key=>$vals)
      {
        $form = new IdentificationsForm($vals);
        $this->embeddedForms['Identifications']->embedForm($key, $form);
      }
      //Re-embedding the container
      $this->embedForm('Identifications', $this->embeddedForms['Identifications']);
    }
    $subForm = new sfForm();
    $this->embedForm('newIdentification',$subForm);
  }

  public function loadEmbedLink()
  {
    if($this->isBound()) return;
    /* extLinks sub form */
    $subForm = new sfForm();
    $this->embedForm('ExtLinks',$subForm);
    if($this->getObject()->getId() !='')
    {
      foreach(Doctrine::getTable('ExtLinks')->findForTable('specimen_individuals', $this->getObject()->getId()) as $key=>$vals)
      {
        $form = new ExtLinksForm($vals,array('table' => 'individuals'));
        $this->embeddedForms['ExtLinks']->embedForm($key, $form);
      }
      //Re-embedding the container
      $this->embedForm('ExtLinks', $this->embeddedForms['ExtLinks']);
    }
    $subForm = new sfForm();
    $this->embedForm('newExtLinks',$subForm);
  }

  public function loadEmbedComment()
  {
    if($this->isBound()) return;

    /* Comments sub form */
    $subForm = new sfForm();
    $this->embedForm('Comments',$subForm);
    if($this->getObject()->getId() !='')
    {
      foreach(Doctrine::getTable('comments')->findForTable('specimen_individuals', $this->getObject()->getId()) as $key=>$vals)
      {
        $form = new CommentsSubForm($vals,array('table' => 'individuals'));
        $this->embeddedForms['Comments']->embedForm($key, $form);
      }
      //Re-embedding the container
      $this->embedForm('Comments', $this->embeddedForms['Comments']);
    }

    $subForm = new sfForm();
    $this->embedForm('newComments',$subForm);
  }

  protected function getFieldsByGroup()
  {
    return array(
      'Type' => array('type'),
      'Sex' => array('sex', 'state'),
      'Stage' => array('stage'),
      'Social' => array('social_status'),
      'Rock' => array('rock_form'),
      'Count' => array(
      'accuracy',
      'specimen_individuals_count_min',
      'specimen_individuals_count_max',
      ),
    );
  }

  public function addIdentifications($num, $order_by=0, $obj=null)
  {
      if(! isset($this['newIdentification'])) $this->loadEmbedIndentifications();
      $options = array('referenced_relation' => 'specimen_individuals', 'order_by' => $order_by);
      if(!$obj) $val = new Identifications();
      else $val = $obj ;
      $val->fromArray($options);
      $val->setRecordId($this->getObject()->getId());
      $form = new IdentificationsForm($val);
      $this->embeddedForms['newIdentification']->embedForm($num, $form);
      //Re-embedding the container
      $this->embedForm('newIdentification', $this->embeddedForms['newIdentification']);
  }

  public function reembedNewIdentifier ($identification, $identifier, $identifier_number)
  {
    $identification->embedForm($identifier_number, $identifier);
    $identification->embedForm('newIdentifier', $identification->embeddedForms['newIdentifier']);
  }


  public function reembedIdentifications ($identification, $identification_number)
  {
      $this->getEmbeddedForm('Identifications')->embedForm($identification_number, $identification);
      $this->embedForm('Identifications', $this->embeddedForms['Identifications']);
  }

  public function reembedNewIdentification ($identification, $identification_number)
  {
      $this->getEmbeddedForm('newIdentification')->embedForm($identification_number, $identification);
      $this->embedForm('newIdentification', $this->embeddedForms['newIdentification']);
  }

  public function addExtLinks($num, $obj=null)
  {
      if(! isset($this['newExtLinks'])) $this->loadEmbedLink();
      $options = array('referenced_relation' => 'specimen_individuals', 'record_id' => $this->getObject()->getId());
      if(!$obj) $val = new ExtLinks();
      else $val = $obj ;      
      $val->fromArray($options);
      $val->setRecordId($this->getObject()->getId());
      $form = new ExtLinksForm($val,array('table' => 'individuals'));
      $this->embeddedForms['newExtLinks']->embedForm($num, $form);
      //Re-embedding the container
      $this->embedForm('newExtLinks', $this->embeddedForms['newExtLinks']);
  }
  
  public function addComments($num, $obj=null)
  {
      if(! isset($this['newComments'])) $this->loadEmbedComment();

      $options = array('referenced_relation' => 'specimen_individuals', 'record_id' => $this->getObject()->getId());
      if(!$obj) $val = new Comments();
      else $val = $obj ;      
      $val->fromArray($options);
      $val->setRecordId($this->getObject()->getId());
      $form = new CommentsSubForm($val,array('table' => 'individuals'));
      $this->embeddedForms['newComments']->embedForm($num, $form);
      //Re-embedding the container
      $this->embedForm('newComments', $this->embeddedForms['newComments']);
  }
  
  public function bind(array $taintedValues = null, array $taintedFiles = null)
  {
    if(isset($taintedValues['accuracy']))
    {
      if($taintedValues['accuracy'] == 0 ) //exact
      {
        $taintedValues['specimen_individuals_count_max'] = $taintedValues['specimen_individuals_count_min'];
      }
    }

    if(!isset($taintedValues['ident']))
    {
      $this->offsetUnset('Identifications');
      unset($taintedValues['Identifications']);
      $this->offsetUnset('newIdentification');
      unset($taintedValues['newIdentification']);
    }
    else
    {
      $this->loadEmbedIndentifications();

      if(isset($taintedValues['newIdentification']))
      {
        foreach($taintedValues['newIdentification'] as $key=>$newVal)
        {
          if (!isset($this['newIdentification'][$key]))
          {
            $this->addIdentifications($key);
              if(isset($taintedValues['newIdentification'][$key]['newIdentifier']))
              {
                foreach($taintedValues['newIdentification'][$key]['newIdentifier'] as $ikey=>$ival)
                {
                  if(!isset($this['newIdentification'][$key]['newIdentifier'][$ikey]))
                  {
                    $identification = $this->getEmbeddedForm('newIdentification')->getEmbeddedForm($key);
                    $identification->addIdentifiers($ikey,$ival['people_ref'], $ival['order_by']);
                    $this->reembedNewIdentification($identification, $key);
                  }
                  $taintedValues['newIdentification'][$key]['newIdentifier'][$ikey]['record_id'] = 0;
                }
              }
            }
            elseif(isset($taintedValues['newIdentification'][$key]['newIdentifier']))
            {
              foreach($taintedValues['newIdentification'][$key]['newIdentifier'] as $ikey=>$ival)
              {
                if(!isset($this['newIdentification'][$key]['newIdentifier'][$ikey]))
                {
                  $identification = $this->getEmbeddedForm('newIdentification')->getEmbeddedForm($key);
                  $identification->addIdentifiers($ikey,$ival['people_ref'], $ival['order_by']);
                  $this->reembedNewIdentification($identification, $key);
                }
                $taintedValues['newIdentification'][$key]['newIdentifier'][$ikey]['record_id'] = 0;
              }
            }
            $taintedValues['newIdentification'][$key]['record_id'] = 0;
        }
      }

      if(isset($taintedValues['Identifications']))
      {
        foreach($taintedValues['Identifications'] as $key=>$newval)
        {
          if(isset($newval['newIdentifier']))
          {
            foreach($taintedValues['Identifications'][$key]['newIdentifier'] as $ikey=>$ival)
            {
              if(!isset($this['Identifications'][$key]['newIdentifier'][$ikey]))
              {
                $identification = $this->getEmbeddedForm('Identifications')->getEmbeddedForm($key);
                $identification->addIdentifiers($ikey,$ival['people_ref'], $ival['order_by']);
                $this->reembedIdentifications($identification, $key);
              }
              $taintedValues['Identifications'][$key]['newIdentifier'][$ikey]['record_id'] = 0;
            }
          }
        }
      }
    }

    if(!isset($taintedValues['comment']))
    {
      $this->offsetUnset('Comments');
      unset($taintedValues['Comments']);
      $this->offsetUnset('newComments');
      unset($taintedValues['newComments']);
    }
    else
    {
      $this->loadEmbedComment();
      if(isset($taintedValues['newComments']))
      {
        foreach($taintedValues['newComments'] as $key=>$newVal)
        {
          if (!isset($this['newComments'][$key]))
          {
            $this->addComments($key);
          }
          $taintedValues['newComments'][$key]['record_id'] = 0;
        }
      }
    }

    if(!isset($taintedValues['extlink']))
    {
      $this->offsetUnset('ExtLinks');
      unset($taintedValues['ExtLinks']);
      $this->offsetUnset('newExtLinks');
      unset($taintedValues['newExtLinks']);
    }
    else
    {
      $this->loadEmbedLink();
      if(isset($taintedValues['newExtLinks']))
      {
        foreach($taintedValues['newExtLinks'] as $key=>$newVal)
        {
          if (!isset($this['newExtLinks'][$key]))
          {
            $this->addExtLinks($key);
          }
          $taintedValues['newExtLinks'][$key]['record_id'] = 0;
        }
      }
    }

    parent::bind($taintedValues, $taintedFiles);
  }

  public function saveEmbeddedForms($con = null, $forms = null)
  {
    if (null === $forms && $this->getValue('ident'))
    {
      $value = $this->getValue('newIdentification');
      foreach($this->embeddedForms['newIdentification']->getEmbeddedForms() as $name => $form)
      {
        if (!isset($value[$name]['value_defined']))
        {
          unset($this->embeddedForms['newIdentification'][$name]);
        }
        else
        {
          $form->getObject()->setRecordId($this->getObject()->getId());
          $form->getObject()->save();
          $subvalue = $value[$name]['newIdentifier'];
          foreach($form->embeddedForms['newIdentifier']->getEmbeddedForms() as $subname => $subform)
          {
            if (!isset($subvalue[$subname]['people_ref']))
            {
              unset($form->embeddedForms['newIdentifier'][$subname]);
            }
            else
            {
              $subform->getObject()->setRecordId($form->getObject()->getId());
            }
          }
        }
      }
      $value = $this->getValue('Identifications');
      foreach($this->embeddedForms['Identifications']->getEmbeddedForms() as $name => $form)
      {
        if (!isset($value[$name]['value_defined']))
        {
          $form->getObject()->delete();
          unset($this->embeddedForms['Identifications'][$name]);
        }
        else
        {
          $subvalue = $value[$name]['newIdentifier'];
          foreach($form->embeddedForms['newIdentifier']->getEmbeddedForms() as $subname => $subform)
          {
            if (!isset($subvalue[$subname]['people_ref']))
            {
              unset($form->embeddedForms['newIdentifier'][$subname]);
            }
            else
            {
              $subform->getObject()->setRecordId($form->getObject()->getId());
            }
          }
          $subvalue = $value[$name]['Identifiers'];
          foreach($form->embeddedForms['Identifiers']->getEmbeddedForms() as $subname => $subform)
          {
            if (!isset($subvalue[$subname]['people_ref']))
            {
              $subform->getObject()->delete();
              unset($form->embeddedForms['Identifiers'][$subname]);
            }
          }
        }
      }
    }

    if (null === $forms && $this->getValue('comment'))
    {
      $value = $this->getValue('newComments');
      foreach($this->embeddedForms['newComments']->getEmbeddedForms() as $name => $form)
      {
        if(!isset($value[$name]['comment'] ))
          unset($this->embeddedForms['newComments'][$name]);
        else
        {
          $form->getObject()->setRecordId($this->getObject()->getId());
        }
      }
      $value = $this->getValue('Comments');
      foreach($this->embeddedForms['Comments']->getEmbeddedForms() as $name => $form)
      {
        if (!isset($value[$name]['comment'] ))
        {
          $form->getObject()->delete();
          unset($this->embeddedForms['Comments'][$name]);
        }
      }
    }

    if (null === $forms && $this->getValue('extlink'))
    {
      $value = $this->getValue('newExtLinks');
      foreach($this->embeddedForms['newExtLinks']->getEmbeddedForms() as $name => $form)
      {
        if(!isset($value[$name]['url']) || $value[$name]['url'] == '')
          unset($this->embeddedForms['newExtLinks'][$name]);
        else
        {
          $form->getObject()->setRecordId($this->getObject()->getId());
        }
      }
      $value = $this->getValue('ExtLinks');
      foreach($this->embeddedForms['ExtLinks']->getEmbeddedForms() as $name => $form)
      {
        if(!isset($value[$name]['url']) || $value[$name]['url'] == '')
        {
          $form->getObject()->delete();
          unset($this->embeddedForms['ExtLinks'][$name]);
        }
      }
    }
    return parent::saveEmbeddedForms($con, $forms);
  }
}
