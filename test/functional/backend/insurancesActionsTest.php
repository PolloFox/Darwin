<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

Doctrine_Query::create()->delete('Insurances')->execute();

$browser = new DarwinTestFunctional(new sfBrowser());
$browser->loadData($configuration)->login('root','evil');

$items = Doctrine::getTable('Igs')->findByIgNum('10795');

$browser->
  info('New Insurance for a given IG')->
  get('/insurances/add?table=igs&id='.$items[0]->getId())->
  with('response')->
  begin()->
    isStatusCode()->
    checkElement('div#insurances_screen')->
    checkElement('form[class="edition qtiped_form"][id="insurances_form"]')->
    checkElement('form input[type="hidden"][name="insurances[referenced_relation]"][value="igs"]')->
    checkElement('form input[type="hidden"][name="insurances[record_id]"][value="'.$items[0]->getId().'"]')->
    checkElement('form table tbody tr:nth-child(2) label[for="insurances_insurance_value"]')->
    checkElement('form table tbody tr:nth-child(2) input[id="insurances_insurance_value"]')->
    checkElement('form table tbody tr:nth-child(3) input[id="insurances_insurance_currency_input"][value="€"]')->
    checkElement('form table tbody tr:nth-child(3) select option', 0)->
    checkElement('form table tbody tr:nth-child(4) select[id="insurances_insurance_year"] option[selected="selected"]', '-')->
  end()->
  info('Try to save no value for IG 10795: wait for value required error...')->
  click('Save', 
        array('insurances' => array('insurance_value' => '',
                                    'insurance_currency' => '€',
                                    'insurance_year' => 0,
                                   )
             )
       )->
  with('form')->
  begin()->
    hasErrors(1)->
    isError('insurance_value', 'required')->
  end()->
  info('Save 750€ value for IG 10795')->
  click('Save', 
        array('insurances' => array('insurance_value' => '750',
                                    'insurance_currency' => '€',
                                    'insurance_year' => 0,
                                   )
             )
       )->
  get('/insurances/add?table=igs&id='.$items[0]->getId())->
  with('response')->
  begin()->
    checkElement('form table tbody tr:nth-child(3) input#insurances_insurance_currency_input')->
    checkElement('form table tbody tr:nth-child(3) select option[value="€"]', '€')->
  end();

$items = Doctrine::getTable('Insurances')->findByInsuranceValue('750');

$browser->
  info('Delete last insurance inserted...')->
  get('catalogue/deleteRelated?table=insurances&id='.$items[0]->getId())->
  with('response')->
  begin()->
    isStatusCode()->
  end();

$counting = Doctrine_Query::create()->select('count(i.id) as counting')->from('insurances i')->execute();

$browser->
  info('Check record has been deleted from DB')->
  test()->is($counting[0]->getCounting(),0);
