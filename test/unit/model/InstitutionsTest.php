<?php 
include(dirname(__FILE__).'/../../bootstrap/Doctrine.php');
$t = new lime_test(7, new lime_output_color());

$t->info('Get Possible types from array');
$institution = new Institutions;
$types = $institution->getTypes();
$t->is(count($types), 1, 'There are "1" differents types');
$t->is($types[8], 'Expert', 'the type "Expert"');
$t->info('Test types for Institutions encoded');

$institutions = Doctrine::getTable('Institutions')->findByIsPhysical(false);
$institutions = Doctrine_Query::create()
            ->from('Institutions')
            ->andWhere('is_physical = false')
            ->orderBy('formated_name_indexed ASC, id ASC')->execute();
$dbTypes = $institutions[0]->getDbPeopleType();
$t->is(count($dbTypes), 0, 'There is "1" type encoded for "'.$institutions[0]->getFormatedName().'"');

$institutions[0]->setDbPeopleType(8);
$institutions[0]->save();
$dbTypes = $institutions[0]->getDbPeopleType();
$t->is(count($dbTypes), 1, 'There are "1" type encoded for "'.$institutions[0]->getFormatedName().'"');
$t->is($types[$dbTypes[0]], 'Expert', 'The DB people type of "'.$institutions[0]->getFormatedName().'" is well "Expert"');
$t->info('Give a wrong array of values for RBINS to see if it has been reset to 0 for type');
$institutions[0]->setDbPeopleType(array(2,15));
$institutions[0]->save();
$dbTypes = $institutions[0]->getDbPeopleType();
$t->is(count($dbTypes), 0, 'There are "0" type encoded for "'.$institutions[0]->getFormatedName().'"');
$t->info('Get the toString of the first institution: RBINS');
$t->is($institutions[0]->__toString(), 'Institut Royal des Sciences Naturelles de Belgique', 'Correct toString of RBINS');
