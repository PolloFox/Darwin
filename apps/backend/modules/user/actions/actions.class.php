<?php

/**
 * user actions.
 *
 * @package    darwin
 * @subpackage user
 * @author     DB team <collections@naturalsciences.be>
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class userActions extends DarwinActions
{
  protected $widgetCategory = 'users_widget';

  public function executeNew(sfWebRequest $request)
  {
    if($this->getUser()->getDbUserType() < Users::MANAGER) $this->forwardToSecureAction();
    $this->mode = 'new' ;
    $this->form = new UsersForm(null, array('mode' => $this->mode));
  }
  
  public function executeEdit(sfWebRequest $request)
  {
    $this->user = Doctrine::getTable('Users')->findExcept( $request->getparameter('id') );
    $this->forward404Unless($this->user, sprintf('User does not exist (%s).', $request->getParameter('id')));
    if($this->getUser()->getId() == $this->user->getId() && !$request->isMethod('post')) 
      $this->redirect('user/profile'); 
    if($request->isMethod('get'))
    {
      if($this->getUser()->getDbUserType() < Users::MANAGER) 
        $this->forwardToSecureAction();
      elseif($this->getUser()->getDbUserType() == Users::MANAGER && $this->getUser()->getDbUserType() == $this->user->getDbUserType()) 
        $this->forwardToSecureAction();
    }
    $this->mode = 'edit' ;
    $this->form = new UsersForm($this->user, array('mode' => $this->mode,'is_physical'=>$this->user->getIsPhysical()));
    $users = $request->getParameter('users');

    if($request->isMethod('post'))
    {
      $this->form->bind($users);
      if($this->form->isValid())
      {
        $this->form->save();
        if( $this->getUser()->getId() == $this->user->getId())
        {
          $this->getUser()->setCulture($this->form->getValue('selected_lang'));
        }
        return $this->redirect('user/edit?id='.$this->user->getId());
      }
    }
    $this->loadWidgets();    
  }
  
  public function executeProfile(sfWebRequest $request)
  { 
    $this->user =  Doctrine::getTable('Users')->findExcept( $this->getUser()->getId() );
    $this->forward404Unless($this->user);
    $this->mode = 'profile' ;
    $this->form = new UsersForm($this->user,array("db_user_type" => $this->getUser()->getDbUserType(),'mode' => $this->mode,'is_physical'=>$this->user->getIsPhysical()));
 /*   if($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('users'));
      if($this->form->isValid())
      { 
		    $this->form->save();
		    return $this->redirect('user/profile');
      }
    }*/
    $this->loadWidgets();    
  }

  /**
    * Action executed when calling the expeditions from an other screen
    * @param sfWebRequest $request Request coming from browser
    */ 
  public function executeChoose(sfWebRequest $request)
  {
    if ($request->hasParameter('num')) $screen = $request->getParameter('num') ;
    else $screen = 3 ;
    $this->form = new UsersFormFilter(null, array("db_user_type" => $this->getUser()->getDbUserType(), "screen" => $screen));
    $this->setLayout(false);
  }

  public function executeIndex(sfWebRequest $request)
  {
    if($this->getUser()->getDbUserType() < Users::MANAGER) $this->forwardToSecureAction();
    $this->form = new UsersFormFilter(null, array("db_user_type" => $this->getUser()->getDbUserType()));
  }

  public function executeSearch(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post')) ;
    $user_filter = $request->getParameter("users_filters") ;
    $this->setCommonValues('user', 'family_name', $request);
    $this->form = new UsersFormFilter(null, array("db_user_type" =>$this->getUser()->getDbUserType(), "screen" => $this->screen));
    $this->is_choose = ($request->getParameter('is_choose', '') == '')?0:intval($request->getParameter('is_choose'));

    if($request->getParameter('users_filters','') !== '')
    {
      $this->form->bind($request->getParameter('users_filters'));

      if ($this->form->isValid())
      {
        $order = $this->orderDir;
        if($this->orderDir == 'asc' && $this->orderBy == 'last_seen')
          $order.= " NULLS FIRST ";
        elseif($this->orderDir == 'desc' && $this->orderBy == 'last_seen')
          $order.= " NULLS last ";
        $query = $this->form->getQuery()->orderBy($this->orderBy .' '.$order);
        // if this is not an admin, make sure no admin and collection manager are visible in the search form
        $this->pagerLayout = new PagerLayoutWithArrows(
          new DarwinPager(
            $query,
            $this->currentPage,
            $this->form->getValue('rec_per_page')
          ),
          new Doctrine_Pager_Range_Sliding(
            array('chunk' => $this->pagerSlidingSize)
          ),
          $this->getController()->genUrl($this->s_url.$this->o_url).'/page/{%page_number}'
        );

        // Sets the Pager Layout templates
        $this->setDefaultPaggingLayout($this->pagerLayout);
        // If pager not yet executed, this means the query has to be executed for data loading
        if (! $this->pagerLayout->getPager()->getExecuted())
           $this->items = $this->pagerLayout->execute();
      }
    }

  }

  public function executeDelete(sfWebRequest $request)
  {
    if($this->getUser()->getDbUserType() < Users::MANAGER) $this->forwardToSecureAction();  
    $request->checkCSRFProtection();

    $this->forward404Unless($this->user = Doctrine::getTable('users')->findUser($request->getParameter('id')), sprintf('User does not exist (%s).', $request->getParameter('id')));
    try{
      $this->user->delete();
      $this->redirect('user/index');
    }
    catch(Doctrine_Exception $ne)
    {
      $e = new DarwinPgErrorParser($ne);
      $error = new sfValidatorError(new savedValidator(),$e->getMessage());
      $this->form = new UsersForm($user,array("db_user_type" => $this->getUser()->getDbUserType(), "is_physical" => $this->user->getIsPhysical()));
      $this->form->getErrorSchema()->addError($error); 
      $this->loadWidgets();
      $this->setTemplate('edit');
    }
  }
  
  public function executeWidget(sfWebRequest $request)
  {
    $id = $request->getparameter('id') ;
    $url = "user/widget?id=".$id ;
    $is_reg_user = false ;
    if (!$id)
    {
      $id = $this->getUser()->getId();
      $url = "user/widget" ;
    }
    else
    { 
      if($this->getUser()->getDbUserType() < Users::MANAGER) $this->forwardToSecureAction();
        $this->forward404Unless($user = Doctrine::getTable('Users')->findExcept($id), sprintf('User does not exist (%s).', $id));
      if($user->getDbUserType() == Users::REGISTERED_USER) $is_reg_user = true ;
    }
    $widget = Doctrine::getTable('MyWidgets')->setUserRef($id)->getWidgetsList($this->getUser()->getDbUserType(), $is_reg_user) ;
    $this->form = new UserWidgetForm(null,array('collection' => $widget, 'level' =>$this->getUser()->getDbUserType()));
    $this->level = $this->getUser()->getAttribute('db_user_type') ; 

    if($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('user_widget')) ;
      if($this->form->isValid())
      {
        $this->form->save();
        return $this->redirect($url);
      }
    }
    $this->form_pref = array();
    foreach($this->form['MyWidgets'] as $keyword)
    {
      $type = $keyword['category']->getValue();
      if(!isset($this->form_pref[$type]))
        $this->form_pref[$type] = array();
      $this->form_pref[$type][] = $keyword;
    }
    $this->user = Doctrine::getTable("Users")->findUser($id) ;
  }

  public function executeAddress(sfWebRequest $request)
  {
    if($this->getUser()->getDbUserType() < Users::MANAGER) 
      if($this->getUser()->getId() != $request->getParameter('ref_id')) $this->forwardToSecureAction();   
    if($request->hasParameter('id'))
    { 
      $this->address =  Doctrine::getTable('UsersAddresses')->findExcept($request->getParameter('id'));
    }
    else
    {
     $this->address = new UsersAddresses();
     $this->address->setPersonUserRef($request->getParameter('ref_id'));
    }
     
    $this->form = new UsersAddressesForm($this->address);
    
    if($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('users_addresses'));
      if($request->getParameter('ref_id') != $this->form->getObject()->getPersonUserRef()) $this->forwardToSecureAction();      
      if($this->form->isValid())
      {
        try
        {
          $this->form->save();
          return $this->renderText('ok');
        }
        catch(Doctrine_Exception $ne)
        {
          $e = new DarwinPgErrorParser($ne);
          return $this->renderText($e->getMessage());
        }
      }
    }
  }


  public function executeGetTags(sfWebRequest $request)
  {
    $this->array_possible = Doctrine::getTable('UsersComm')->getTags($request->getParameter('type'));
  }

  public function executeComm(sfWebRequest $request)
  {
    if($this->getUser()->getDbUserType() < Users::MANAGER) 
      if($this->getUser()->getId() != $request->getParameter('ref_id')) $this->forwardToSecureAction(); 
    if($request->hasParameter('id'))
    { 
      $this->comm =  Doctrine::getTable('UsersComm')->findExcept($request->getParameter('id'));
    }
    else
    {
     $this->comm = new UsersComm();
     $this->comm->setPersonUserRef($request->getParameter('ref_id'));
    }
     
    $this->form = new UsersCommForm($this->comm);
    
    if($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('users_comm'));
      if($request->getParameter('ref_id') != $this->form->getObject()->getPersonUserRef()) $this->forwardToSecureAction();      
      if($this->form->isValid())
      {
        try
        {
          $this->form->save();
        }
        catch(Exception $e)
        {
          return $this->renderText($e->getMessage());
        }
        return $this->renderText('ok');
      }
    }
  }
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $this->mode = 'new';
    if($this->getUser()->getDbUserType()  < Users::MANAGER) $this->forwardToSecureAction();
    $this->form = new UsersForm(null, array("db_user_type" => $this->getUser()->getDbUserType(),'mode' =>$this->mode));

    $this->form->bind($request->getParameter($this->form->getName()));

    if ($this->form->isValid())
    {
      try{
        $this->user = $this->form->save();
        $this->user->addUserWidgets();
        $this->redirect('user/edit?id='.$this->user->getId());
      }
      catch(Doctrine_Exception $ne)
      {
        $e = new DarwinPgErrorParser($ne);
        $error = new sfValidatorError(new savedValidator(),$e->getMessage());
        $this->form->getErrorSchema()->addError($error);
      }
    }
    $this->setTemplate('new');
  }

  public function executeLoginInfo(sfWebRequest $request)
  {
    if(! $this->getUser()->isAtLeast(Users::MANAGER))
      if($this->getUser()->getId() != $request->getParameter('user_ref'))
        $this->forwardToSecureAction();
    $this->forward404Unless($this->user = Doctrine::getTable('Users')->findExcept($request->getparameter('user_ref')), sprintf('User does not exist (%s).', $request->getParameter('user_ref')));
    $this->loginInfo = Doctrine::getTable('UsersLoginInfos')->findExcept($request->getParameter('id'));
    if( ! $this->loginInfo )
    {
      $this->loginInfo = new UsersLoginInfos() ;
      $this->loginInfo->setUserRef($request->getParameter('user_ref')) ;
    }
    $this->form = new UsersLoginInfosForm($this->loginInfo);
    if($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('users_login_infos'));
      if($request->getParameter('user_ref') != $this->form->getValue('user_ref')) $this->forwardToSecureAction();
      if($this->form->isValid())
      {
        try{
          $this->form->save();
        }
        catch(Exception $e)
        {
          return $this->renderText($e->getMessage());
        }
        return $this->renderText('ok');
      }
    }
  }

  public function executeLang(sfWebRequest $request)
  {
    if($this->getUser()->getDbUserType() < Users::MANAGER) 
      if($this->getUser()->getId() != $request->getParameter('ref_id')) $this->forwardToSecureAction();  
    if($request->hasParameter('id'))
    {  
      $this->lang =  Doctrine::getTable('UsersLanguages')->findExcept($request->getParameter('id'));
    }
    else
    {
     $this->lang = new UsersLanguages();
     $this->lang->setUsersRef($request->getParameter('ref_id'));
    }
     
    $this->form = new UsersLanguagesForm($this->lang);
    
    if($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('users_languages'));
      if($request->getParameter('ref_id') != $this->form->getValue('users_ref')) $this->forwardToSecureAction();      
      if($this->form->isValid())
      {
        try
        {
          if($this->form->getValue('preferred_language') && ! $this->lang->getPreferredLanguage() )
          {
            Doctrine::getTable('UsersLanguages')->removeOldPreferredLang($this->lang->getUsersRef());
          }

          $this->form->save();
          return $this->renderText('ok');
        }
        catch(Doctrine_Exception $e)
        {
          $error = new sfValidatorError(new savedValidator(),$e->getMessage());
          $this->form->getErrorSchema()->addError($error); 
        }
      }
    }
  }

  public function executePreferences(sfWebRequest $request)
  {
    $this->form = new PreferencesForm(null, array('user'=>$this->getUser()));
    if($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('preferences'));
      if($this->form->isValid())
      {
        $this->form->save();
        if($this->getUser()->getHelpIcon() != $this->form['help_message_activated']->getValue()) 
          $this->getUser()->setHelpIcon($this->form['help_message_activated']->getValue()) ;
        return $this->redirect('user/preferences');
      }
    }
  }
  
  public function executeRightSummary(sfWebRequest $request)
  {
    if($request->hasParameter('id')) 
    {
      $user_id = $request->getParameter('id') ;
      if(! $this->getUser()->isAtLeast(Users::MANAGER) ) $this->forwardToSecureAction();
    }
    else $user_id = $this->getUser()->getId() ;
    $this->summary = array(Users::REGISTERED_USER=>$this->getI18N()->__('You can view private specimens linked to this collection'),
                           Users::ENCODER=>$this->getI18N()->__('You can edit specimens linked to this collection'),
                           Users::MANAGER=>$this->getI18N()->__('You are Manager of this collection')) ;
    $this->rights = Doctrine::getTable('collectionsRights')->findByUserRef($user_id) ;
    $this->widgets = array() ;
    if ($this->getUser()->isA(Users::REGISTERED_USER))
    {
      $specific_rights = Doctrine::getTable('myWidgets')->findByUserRef($user_id) ;
      foreach($specific_rights as $rights)
      {
        if($rights->getCollections() != ",")
        {          
          $tab = explode(',',$rights->getCollections()) ;
          foreach($tab as $collections)
          {
            if($collections != "")
            {
              if(!isset($this->widgets[$collections])) $this->widgets[$collections] = array() ;
              if(!isset($this->widgets[$collections][$rights->getCategory()])) $this->widgets[$collections][$rights->getCategory()] = array() ;          
              $this->widgets[$collections][$rights->getCategory()][] = "<b>".$rights->getGroupName()."</b> (".$rights->getTitlePerso().")" ;
            }
          }
        }
      }    
    }    
  }
}
