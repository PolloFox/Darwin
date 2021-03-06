<?php 
class trackingFilter extends sfFilter
{
  public function execute ($filterChain)
  {
    if ($this->isFirstCall())
    {
      $user = $this->getContext()->getUser();

      if($user->isAuthenticated())
      {

        //Check if the user still exists
        $q = Doctrine_Query::create()
          ->useResultCache(new Doctrine_Cache_Apc())
          ->setResultCacheLifeSpan(60 * 5) //5 minutes
          ->from('Users')
          ->andWhere('id = ?',$user->getId());
        $usr=$q->fetchOne();

        if(!$usr)
        {
          $user->clearCredentials();
          $user->setAuthenticated(false);

          return $this->getContext()->getController()->redirect('homepage');
        }
        $user->setAttribute('db_user_type', $usr->getDbUserType());
      }
      if($user->isAuthenticated() && sfConfig::get('app_tracking_enabled',null))
      {
        $conn = Doctrine_Manager::connection();
        $conn->exec("select fct_set_user(".$user->getId().");");
      }
    }

    $filterChain->execute();
  }
}