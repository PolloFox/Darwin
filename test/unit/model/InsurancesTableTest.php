<?php 
include(dirname(__FILE__).'/../../bootstrap/Doctrine.php');
$t = new lime_test(8, new lime_output_color());

$lastIg = Doctrine::getTable('igs')->findOneByIgNum('2653');
$insurances = new Insurances();
$insurances->setInsuranceValue(750);
$insurances->setInsuranceCurrency('€');
$insurances->setInsuranceYear(1975);
$insurances->setReferencedRelation('igs');
$insurances->setRecordId($lastIg->getId());
$insurances->save();

$insurances = Doctrine::getTable('insurances')->findForTable('igs', $lastIg->getId());
$t->is( count($insurances) , 1, 'Theres a new insurance inserted...');
$t->is( $insurances[0]->getInsuranceValue() , 750, 'Insurance value is well "750"');
$t->is( $insurances[1]->getInsuranceCurrency() , '€', 'Insurance currency is well "€"');
$t->is( $insurances[2]->getInsuranceYear() , 0, 'Insurance year is well "0"');

$insurances = new Insurances();
$insurances->setInsuranceValue(1000);
$insurances->setInsuranceCurrency('$');
$insurances->setInsuranceYear(1976);
$insurances->setReferencedRelation('igs');
$insurances->setRecordId($lastIg->getId());
$insurances->save();

$insurances = Doctrine::getTable('insurances')->findForTable('igs', $lastIg->getId());
$t->is( count($insurances) , 2, 'Theres a new insurance inserted...');
$insurance_currencies = Doctrine::getTable('insurances')->getDistinctCurrencies();
$t->is( count($insurance_currencies) , 2, 'There are two distinct insurance currencies');
$t->is( $insurance_currencies[0]->getCurrencies() , '$', 'Fisrt currency is "$"');
$t->is( $insurance_currencies[1]->getCurrencies() , '€', 'Fisrt currency is "€"');
