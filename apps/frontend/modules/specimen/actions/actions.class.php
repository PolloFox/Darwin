<?php

/**
 * board actions.
 *
 * @package    darwin
 * @subpackage board
 * @author     DB team <collections@naturalsciences.be>
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class specimenActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
     $this->widgets = Doctrine::getTable('MyPreferences')
      ->setUserRef($this->getUser()->getAttribute('db_user')->getId())
      ->getWidgets('specimen_widget');
  }
  
  public function executeSubmit(sfWebRequest $request)
  {
    $this->form = new SpecimensForm();
    $this->forward404Unless($request->isMethod('post'));
    $this->form->bind($request->getParameter('specimen'));
    if ($this->form->isValid())
    {
        $this->redirect('contact/thankyou?'.http_build_query($this->form->getValues()));
    }
    //$this->forward('specimen','index');
    return $this->renderText(  $this->form);
  }
}
