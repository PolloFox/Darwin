<?php

/**
 * Comments form.
 *
 * @package    form
 * @subpackage Comments
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class CommentsForm extends BaseCommentsForm
{
  public function configure()
  {
    $choices = CommentsTable::getNotionsFor($this->options['table']);
    $this->widgetSchema['referenced_relation'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['record_id'] = new sfWidgetFormInputHidden();
    unset($this['comment_ts']);
    unset($this['comment_language_full_text']); // @TODO : check this!
    $this->widgetSchema['notion_concerned'] =  new sfWidgetFormChoice(array(
      'choices' =>  $choices,  
    ));
    $this->validatorSchema['notion_concerned'] = new sfValidatorChoice(array('required'=>true,'choices'=>array_keys($choices)));
    $this->validatorSchema['comment'] = new sfValidatorString(array('trim'=>true, 'required'=>true));

  }
}
