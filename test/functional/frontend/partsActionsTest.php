<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());

$browser->
  get('/parts/index')->

  with('request')->begin()->
    isParameter('module', 'parts')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    isStatusCode(404)->
    checkElement('body', '!/This is a temporary page/')->
  end()
;
