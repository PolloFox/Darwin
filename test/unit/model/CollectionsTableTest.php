<?php 
include(dirname(__FILE__).'/../../bootstrap/Doctrine.php');
$t = new lime_test(8, new lime_output_color());

$t->info('fetchByInstitutionList');
$list = Doctrine::getTable('Collections')->fetchByInstitutionList();

$t->is($list[0]->getFormatedName(),'Institut Royal des Sciences Naturelles de Belgique','Thre list give institutions');
$collections = $list[0]->Collections;

$t->is(count($collections),4,'Get all collections');
$t->is($collections[0]->getPath(),'/','The first item has path /');
$t->is($collections[3]->getName(),'Fossile Aves','The childrens item are also fetched');

$t->is($list[1]->getFormatedName(),'UGMM','Thre list give institutions');

$collections = $list[1]->Collections;

$t->is($collections[0]->getName(),'Molusca','The last item is molusca (correctly order)');


$t->info('getDistinctCollectionByInstitution');

$list2 = Doctrine::getTable('Collections')->getDistinctCollectionByInstitution($list[0]->getId());
$t->is(count($list2), 5, 'We have 5 collections in this institution ("" + 4)');

$list2 = Doctrine::getTable('Collections')->getDistinctCollectionByInstitution($list[1]->getId());
$t->is(count($list2), 2, 'We have 2 collections in this institution ("" + 1)');
