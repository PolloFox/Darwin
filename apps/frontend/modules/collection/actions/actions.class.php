<?php

/**
 * collection actions.
 *
 * @package    darwin
 * @subpackage collection
 * @author     DB team <collections@naturalsciences.be>
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class collectionActions extends sfActions
{

  public function executeChoose(sfWebRequest $request)
  {
    $this->institutions = Doctrine::getTable('Collections')->fetchByInstitutionList();
    $this->setLayout(false);
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $this->institutions = Doctrine::getTable('Collections')->fetchByInstitutionList();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CollectionsForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new CollectionsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($collections = Doctrine::getTable('Collections')->find(array($request->getParameter('id'))), sprintf('Object collections does not exist (%s).', array($request->getParameter('id'))));
    $this->form = new CollectionsForm($collections);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($collections = Doctrine::getTable('Collections')->find(array($request->getParameter('id'))), sprintf('Object collections does not exist (%s).', array($request->getParameter('id'))));
    $this->form = new CollectionsForm($collections);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

   /**
   * @TODO: PREVENT error when has child!
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($collections = Doctrine::getTable('Collections')->find(array($request->getParameter('id'))), sprintf('Object collections does not exist (%s).', array($request->getParameter('id'))));
    $collections->delete();

    $this->redirect('collection/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $collections = $form->save();

      $this->redirect('collection/index');
    }
  }
}
