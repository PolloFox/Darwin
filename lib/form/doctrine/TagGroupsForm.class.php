<?php

/**
 * TagGroups form.
 *
 * @package    form
 * @subpackage TagGroups
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class TagGroupsForm extends BaseTagGroupsForm
{
  public function configure()
  {
     unset(
      $this['group_name_indexed'],
      $this['sub_group_name_indexed'],
      $this['gtu_ref'],
      $this['color']
     );
    $this->validatorSchema['group_name']->setOption('required', false);
    $this->validatorSchema['sub_group_name']->setOption('required', false);
    $this->validatorSchema['tag_value']->setOption('required', false);

    $this->widgetSchema['group_name'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['group_name']->setDefault('administrative');

    $this->widgetSchema['sub_group_name'] = new widgetFormSelectComplete(array(
        'model' => 'TagGroups',
	'change_label' => 'Pick a sub-type in the list',
	'add_label' => 'Add another sub-type',
    ));

    $this->widgetSchema['sub_group_name']->setOption('forced_choices', Doctrine::getTable('TagGroups')->getDistinctSubGroups($this->getObject()->getGroupName()) );
  
    $this->widgetSchema['tag_value'] = new sfWidgetFormInputText();

  }
}
