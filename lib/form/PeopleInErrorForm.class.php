<?php

class PeopleInErrorForm extends BaseCataloguePeopleForm
{

  public function configure()
  {
    $name = isset($this->options['default_name'])?$this->options['default_name']:'';  
    $link = isset($this->options['donator'])?'people/searchBoth':'people/choose?only_role='.$this->options['only_role'].'&name='.$name;  
    $this->widgetSchema['people_ref'] = new widgetFormButtonRef(array(
       'model' => 'People',
       'link_url' => $link,
       'method' => 'getFormatedName',
       'default_name' => $name,
       'box_title' => $this->getI18N()->__('Choose People'),
       'nullable' => false,
       'button_class'=>'',
     ),
      array('class'=>'inline',
           )
    );
    $this->validatorSchema['people_ref'] = new sfValidatorInteger(array('required'=>false));
    $this->widgetSchema['people_type'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['referenced_relation'] = new sfWidgetFormInputHidden();
    $this->validatorSchema['referenced_relation'] = new sfValidatorString();
    $this->widgetSchema['record_id'] = new sfWidgetFormInputHidden();    
    $this->validatorSchema['record_id'] = new sfValidatorInteger();
    $this->widgetSchema['people_sub_type'] = new sfWidgetFormInputHidden(array('default'=>''));
    $this->validatorSchema['people_sub_type'] = new sfValidatorString(array('required'=>false));
    $this->widgetSchema['order_by'] = new sfWidgetFormInputHidden();
    $this->validatorSchema['order_by'] = new sfValidatorInteger();
    $this->validatorSchema['id'] = new sfValidatorInteger(array('required'=>false));

    /*Identifiers post-validation to empty null values*/
    $this->mergePostValidator(new IdentifiersValidatorSchema());

  }
}
