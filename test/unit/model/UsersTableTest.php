<?php 
include(dirname(__FILE__).'/../../bootstrap/Doctrine.php');
 
$t = new lime_test(5, new lime_output_color());
$t->comment('->getUserByPassword()');
$t->is(Doctrine::getTable('Users')->getUserByPassword("root","brol"),false,'Test the local login with a wrong password');
$t->is(Doctrine::getTable('Users')->getUserByPassword("root","evil")->getFamilyName(),"Evil",'Test the local login with a good password');
$t->is(''.Doctrine::getTable('Users')->getUserByPassword("root","evil"),"Evil Root (Mr)",'Test the local login with a good password');
$u = Doctrine::getTable('Users')->getUserByPassword("root","evil");

$t->is(Doctrine::getTable('UsersLanguages')->getPreferredLanguage($u->getId())->getLanguageCountry(),'en','En is the preferred lang');

$nu = new Users() ;
$nu->setFamilyName('Chambert') ;
$nu->setGivenName('Yann') ;
$nu->setGender('M') ;
$nu->setDbUserType(1) ;
$nu->setIsPhysical(true) ;
$nu->save() ;
$t->comment('->findUser()') ;
$t->is(Doctrine::getTable('Users')->findUser($nu->getId())->getFamilyName(),'Chambert', 'User Chambert is created') ;
$uli = new UsersLoginInfos() ;


