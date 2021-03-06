\unset ECHO
\i unit_launch.sql
SELECT plan(101);

SELECT diag('Darwin flat synchro tests');

-- Insertion of catalogues data
INSERT INTO users(id, family_name, formated_name) VALUES (100000, 'Jos Chevremont', 'Jos Chevremont');
INSERT INTO users(id, family_name, formated_name) VALUES (100001, 'Paul Damblon', 'Paul Damblon');
INSERT INTO people(id, is_physical, db_people_type, sub_type, family_name, formated_name) VALUES (100002, false, 1, 'Federal Institution', 'Institut des Cocinnelles', 'Institut des Cocinnelles');
INSERT INTO people(id, is_physical, db_people_type, sub_type, family_name, formated_name) VALUES (100003, false, 1, 'ASBL', 'Centre d''écologie urbaine', 'Centre d''écologie urbaine');
INSERT INTO collections(id, code, name, institution_ref, main_manager_ref) VALUES (100000, 'Bulots', 'Bulots', 100002, 100000);
INSERT INTO collections(id, code, name, institution_ref, main_manager_ref, parent_ref) VALUES (100001, 'Bulots Af.', 'Bulots d''Afrique', 100002, 100000, 100000);
INSERT INTO collections(id, code, name, institution_ref, main_manager_ref, parent_ref) VALUES (100002, 'Bulots As.', 'Bulots d''Asie', 100002, 100000, 100000);
INSERT INTO collections(id, code, name, institution_ref, main_manager_ref) VALUES (100004, 'Crétins', 'Crétins', 100003, 100001);
INSERT INTO collections(id, code, name, institution_ref, main_manager_ref, parent_ref) VALUES (100005, 'Crétins EU', 'Crétins européens', 100003, 100001, 100004);
INSERT INTO collections(id, code, name, institution_ref, main_manager_ref, parent_ref) VALUES (100006, 'Crétins US.', 'Crétins américains', 100003, 100001, 100004);
INSERT INTO expeditions(id, name) VALUES (100000, 'Atlantic city 2010');
INSERT INTO expeditions(id, name) VALUES (100001, 'Bruxelles-Brussels');
INSERT INTO gtu(id, code) VALUES (100000, 'BELGO');
INSERT INTO gtu(id, code, parent_ref) VALUES (100001, 'Bxl', 100000);
INSERT INTO gtu(id, code, parent_ref) VALUES (100002, 'Brugge', 100000);
INSERT INTO tag_groups(id, gtu_ref, group_name, sub_group_name, tag_value) VALUES (100000, 100000, 'Administrative area', 'Country', 'Belgique;Belgium;Belgïe');
INSERT INTO tag_groups(id, gtu_ref, group_name, sub_group_name, tag_value) VALUES (100001, 100001, 'Administrative area', 'Country', 'Belgique;Belgium;Belgïe');
INSERT INTO tag_groups(id, gtu_ref, group_name, sub_group_name, tag_value) VALUES (100002, 100001, 'Administrative area', 'City', 'Bruxelles;Brussel;Brussels;Brüsel');
INSERT INTO tag_groups(id, gtu_ref, group_name, sub_group_name, tag_value) VALUES (100003, 100002, 'Administrative area', 'Country', 'Belgique;Belgium;Belgïe');
INSERT INTO tag_groups(id, gtu_ref, group_name, sub_group_name, tag_value) VALUES (100004, 100002, 'Administrative area', 'City', 'Brugge;Bruge');
INSERT INTO taxonomy(id, name, level_ref, parent_ref) VALUES (100000, 'Anicracra', 2, -1);
INSERT INTO taxonomy(id, name, level_ref, parent_ref) VALUES (100001, 'Aniblabla', 2, -1);
INSERT INTO chronostratigraphy(id, name, level_ref, parent_ref) VALUES (100000, 'Devotien', 55, 0);
INSERT INTO chronostratigraphy(id, name, level_ref, parent_ref) VALUES (100001, 'Chronocouche', 55, 0);
INSERT INTO lithostratigraphy(id, name, level_ref, parent_ref) VALUES (100000, 'Croute basse', 64, 0);
INSERT INTO lithostratigraphy(id, name, level_ref, parent_ref) VALUES (100001, 'Lithocroute', 64, 0);
INSERT INTO lithology(id, name, level_ref, parent_ref) VALUES (100000, 'Petits cailloux', 75, 0);
INSERT INTO lithology(id, name, level_ref, parent_ref) VALUES (100001, 'Gros rochers', 75, 0);
INSERT INTO mineralogy(id, code, name, level_ref, parent_ref) VALUES (100000, 'CAM1', 'Camion', 70, 0);
INSERT INTO mineralogy(id, code, name, level_ref, parent_ref) VALUES (100001, 'ON2', 'Onion', 70, 0);
INSERT INTO igs(id, ig_num) VALUES (100000, '240275');
INSERT INTO igs(id, ig_num) VALUES (100001, '240276');
-- Insertion of specimens using these data
INSERT INTO specimens (id, collection_ref, expedition_ref, gtu_ref, taxon_ref, chrono_ref, litho_ref, lithology_ref, mineral_ref)
       VALUES (100000,100001,100000,100001,100000,100000,100000,100000,100000);
INSERT INTO specimens (id, collection_ref, expedition_ref, gtu_ref, taxon_ref, chrono_ref, litho_ref, lithology_ref, mineral_ref, ig_ref, host_relationship, host_taxon_ref)
       VALUES (100001,100005,100001,100002,100001,100001,100001,100001,100001,100001,'Parasit',100000);

SELECT ok(100000 = (SELECT spec_ref FROM darwin_flat WHERE id = 1), 'First specimen inserted is well the specimen "100000".');
SELECT ok('physical' = (SELECT category FROM darwin_flat WHERE id = 1), 'It''s well a "physical" specimen.');
SELECT ok(100001 = (SELECT collection_ref FROM darwin_flat WHERE id = 1), 'Collection referenced is well "100001".');
SELECT ok('mix' = (SELECT collection_type FROM darwin_flat WHERE id = 1), 'Collection referenced type is well "mix".');
SELECT ok('Bulots Af.' = (SELECT collection_code FROM darwin_flat WHERE id = 1), 'Collection referenced code is well "Bulots Af.".');
SELECT ok('Atlantic city 2010' = (SELECT expedition_name FROM darwin_flat WHERE id = 1), 'Expedition is well "Atlantic city 2010".');
SELECT ok (ARRAY['belgium','belgie','belgique','brussel','bruxelles','brussels','brusel']::varchar[] = (SELECT gtu_tag_values_indexed FROM darwin_flat WHERE id = 1), 'Tag list is correct');
SELECT ok ('Belgique;Belgium;Belgïe' = (SELECT gtu_country_tag_value FROM darwin_flat WHERE id = 1), 'Country Tag value is correct');
SELECT ok('Anicracra' = (SELECT taxon_name FROM darwin_flat WHERE id = 1), 'Taxon is well "Anicracra".');
SELECT ok('Devotien' = (SELECT chrono_name FROM darwin_flat WHERE id = 1), 'Chrono unit is well "Devotien".');
SELECT ok('Croute basse' = (SELECT litho_name FROM darwin_flat WHERE id = 1), 'Litho unit is well "Croute basse".');
SELECT ok('Petits cailloux' = (SELECT lithology_name FROM darwin_flat WHERE id = 1), 'Lithology unit is well "Petits cailloux".');
SELECT ok('Camion' = (SELECT mineral_name FROM darwin_flat WHERE id = 1), 'Mineral unit is well "Camion".');
SELECT ok('0' = (SELECT coalesce(ig_num,'0') FROM darwin_flat WHERE id = 1), 'No ig num for specimen 1.');
SELECT ok(100001 = (SELECT spec_ref FROM darwin_flat WHERE id = 2), 'Second specimen inserted is well the specimen "100001".');
SELECT ok('physical' = (SELECT category FROM darwin_flat WHERE id = 2), 'It''s well a "physical" specimen.');
SELECT ok(100005 = (SELECT collection_ref FROM darwin_flat WHERE id = 2), 'Collection referenced is well "100002".');
SELECT ok('mix' = (SELECT collection_type FROM darwin_flat WHERE id = 2), 'Collection referenced type is well "mix".');
SELECT ok('Crétins EU' = (SELECT collection_code FROM darwin_flat WHERE id = 2), 'Collection referenced code is well "Crétins EU".');
SELECT ok('Bruxelles-Brussels' = (SELECT expedition_name FROM darwin_flat WHERE id = 2), 'Expedition is well "Bruxelles-Brussels".');
SELECT ok (ARRAY['belgium','belgie','belgique','brugge','bruge']::varchar[] = (SELECT gtu_tag_values_indexed FROM darwin_flat WHERE id = 2), 'Tag list is correct');
SELECT ok ('Belgique;Belgium;Belgïe' = (SELECT gtu_country_tag_value FROM darwin_flat WHERE id = 2), 'Country Tag value is correct');
SELECT ok('Aniblabla' = (SELECT taxon_name FROM darwin_flat WHERE id = 2), 'Taxon is well "Aniblabla".');
SELECT ok('Chronocouche' = (SELECT chrono_name FROM darwin_flat WHERE id = 2), 'Crhono unit is well "Chronocouche".');
SELECT ok('Lithocroute' = (SELECT litho_name FROM darwin_flat WHERE id = 2), 'Litho unit is well "Lithocroute".');
SELECT ok('Gros rochers' = (SELECT lithology_name FROM darwin_flat WHERE id = 2), 'Lithology unit is well "Petits cailloux".');
SELECT ok('Onion' = (SELECT mineral_name FROM darwin_flat WHERE id = 2), 'Mineral unit is well "Onion".');
SELECT ok('240276' = (SELECT ig_num FROM darwin_flat WHERE id = 2), 'ig num "240276" for specimen 2.');

-- UPDATE of collection manager data -> for users trigger check

UPDATE users SET family_name = 'Jojoba', formated_name = 'Jojoba' WHERE id = 100000;
UPDATE users SET family_name = 'Caloulou', formated_name = 'Caloulou' WHERE id = 100001;


-- UPDATE of collection institution data -> for people trigger check

UPDATE people SET sub_type = 'Small Institution' WHERE id = 100002;
UPDATE people SET family_name = 'ECOLO', formated_name = 'ECOLO' WHERE id = 100003;

-- UPDATE of 3 collections institution and main manager reference data -> for collections trigger check

UPDATE collections SET institution_ref = 100003, main_manager_ref = 100001 WHERE id = 100000;

-- UPDATE of tag_value of cities for gtu 100001 -> should have no impact on gtu_country_tag_value but well on gtu_tag_values_indexed

UPDATE tag_groups SET tag_value = 'Liège;Luik;Lutig' WHERE gtu_ref = 100001 AND group_name_indexed = 'administrativearea' AND sub_group_name_indexed = 'city';

SELECT ok (ARRAY['belgium','belgie','belgique','liege','lutig','luik']::varchar[] = (SELECT gtu_tag_values_indexed FROM darwin_flat WHERE id = 1), 'Tag list is correct');
SELECT ok ('Belgique;Belgium;Belgïe' = (SELECT gtu_country_tag_value FROM darwin_flat WHERE id = 1), 'Country Tag value is correct');
SELECT ok (ARRAY['belgium','belgie','belgique','brugge','bruge']::varchar[] = (SELECT gtu_tag_values_indexed FROM darwin_flat WHERE id = 2), 'Tag list is correct');
SELECT ok ('Belgique;Belgium;Belgïe' = (SELECT gtu_country_tag_value FROM darwin_flat WHERE id = 2), 'Country Tag value is correct');

-- UPDATE of tag_value of country for gtu 100001 -> should have impact either on gtu_country_tag_value but well on gtu_tag_values_indexed too

UPDATE tag_groups SET tag_value = 'Belgique;Belgium;Belgïe;Belgo' WHERE gtu_ref = 100001 AND group_name_indexed = 'administrativearea' AND sub_group_name_indexed = 'country';

SELECT ok (ARRAY['liege','lutig','luik','belgium','belgo','belgie','belgique']::varchar[] = (SELECT gtu_tag_values_indexed FROM darwin_flat WHERE id = 1), 'Tag list is correct');
SELECT ok ('Belgique;Belgium;Belgïe;Belgo' = (SELECT gtu_country_tag_value FROM darwin_flat WHERE id = 1), 'Country Tag value is correct');
SELECT ok (ARRAY['belgium','belgie','belgique','brugge','bruge']::varchar[] = (SELECT gtu_tag_values_indexed FROM darwin_flat WHERE id = 2), 'Tag list is correct');
SELECT ok ('Belgique;Belgium;Belgïe' = (SELECT gtu_country_tag_value FROM darwin_flat WHERE id = 2), 'Country Tag value is correct');

-- Delete the country tag group for gtu 100001

DELETE FROM tag_groups WHERE gtu_ref = 100001 AND group_name_indexed = 'administrativearea' AND sub_group_name_indexed = 'country';

SELECT ok (ARRAY['liege','lutig','luik']::varchar[] = (SELECT gtu_tag_values_indexed FROM darwin_flat WHERE id = 1), 'Tag list correctly updated');
SELECT ok ('0' = (SELECT coalesce(gtu_country_tag_value,'0') FROM darwin_flat WHERE id = 1), 'Country Tag value correctly updated');

-- Reset country sub group of gtu 100001 to Belgique;Belgïe;Belgium

INSERT INTO tag_groups (gtu_ref, group_name, sub_group_name, tag_value) VALUES (100001, 'Administrative area', 'Country', 'Belgique;Belgium;Belgïe');

SELECT ok (ARRAY['belgium','belgie','belgique','liege','lutig','luik']::varchar[] = (SELECT gtu_tag_values_indexed FROM darwin_flat WHERE id = 1), 'Tag list is correct');
SELECT ok ('Belgique;Belgium;Belgïe' = (SELECT gtu_country_tag_value FROM darwin_flat WHERE id = 1), 'Country Tag value is correct');

-- Redelete the country tag group for gtu 100001 by updating the sub group value to an idot one

-- UPDATE tag_groups SET group_name = 'Topographic', sub_group_name = 'Landscape' WHERE gtu_ref = 100001 AND group_name_indexed = 'administrativearea' AND sub_group_name_indexed = 'country';
--
-- SELECT ok (ARRAY['belgium','belgie','belgique','liege','lutig','luik']::varchar[] = (SELECT gtu_tag_values_indexed FROM darwin_flat WHERE id = 1), 'Tag list correctly updated');
-- SELECT ok ('0' = (SELECT coalesce(gtu_country_tag_value,'0') FROM darwin_flat WHERE id = 1), 'Country Tag value correctly updated');

-- UPDATE of taxon name and extinct of taxon 100001

UPDATE taxonomy SET name = 'Gloubiboulga', extinct = true where id = 100001;

SELECT ok(true = (SELECT taxon_extinct FROM darwin_flat WHERE id = 2), 'Taxon of specimen 2 is now extinct');
SELECT ok('Gloubiboulga' = (SELECT taxon_name FROM darwin_flat WHERE id = 2), 'And its name is correct');

-- UPDATE of collection_ref, IG num, taxon_ref and gtu_ref of specimen 2

UPDATE specimens SET collection_ref = 100006, gtu_ref = 100000, taxon_ref = 100000, ig_ref = 100000 where id = 100001;

SELECT ok('Crétins US.' = (SELECT collection_code FROM darwin_flat WHERE id = 2), 'Collection referenced code is well "Crétins US".');
SELECT ok('Crétins américains' = (SELECT collection_name FROM darwin_flat WHERE id = 2), 'Collection referenced name is well "Crétins américains".');
SELECT ok(ARRAY['belgium','belgie','belgique']::varchar[] = (SELECT gtu_tag_values_indexed FROM darwin_flat WHERE id = 2), 'Tag list is correct');
SELECT ok('Belgique;Belgium;Belgïe' = (SELECT gtu_country_tag_value FROM darwin_flat WHERE id = 2), 'Country Tag value is correct');
SELECT ok('BELGO' = (SELECT gtu_code FROM darwin_flat WHERE id = 2), 'The gtu has been well updated ;)');
SELECT ok('Anicracra' = (SELECT taxon_name FROM darwin_flat WHERE id = 2), 'Taxon is well "Anicracra".');
SELECT ok('240275' = (SELECT ig_num FROM darwin_flat WHERE id = 2), 'ig num "240275" for specimen 2.');

-- Test delete of ig num -> set to null value in darwin_flat

SELECT throws_ok('DELETE FROM igs where ig_num = ''240275''');


-- Tests individuals interactions

SELECT ok(false = (SELECT with_individuals FROM darwin_flat WHERE spec_ref = 100001), 'With individuals value well false for specimen 100001');

INSERT INTO specimen_individuals (id, specimen_ref, type) VALUES (240275, 100001, 'holotype');

SELECT ok(240275 = (SELECT individual_ref FROM darwin_flat WHERE spec_ref = 100001), 'Individual well inserted in flat');
SELECT ok(true = (SELECT with_individuals FROM darwin_flat WHERE spec_ref = 100001), 'and with individuals well set to true');
SELECT lives_ok('INSERT INTO specimen_individuals (id, specimen_ref, type) VALUES (240276, 100001, ''paratype'')', 'Insertion of a new individual for specimen 100001');
SELECT ok(2 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100001 AND with_individuals = true), 'Creates well a new line');
SELECT ok(1 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100001 AND individual_ref = 240276), '... and with good values');

-- Test parts interactions

INSERT INTO specimen_parts (id, specimen_individual_ref, specimen_part) VALUES (240275, 240276, 'specimen');

SELECT ok(240275 = (SELECT part_ref FROM darwin_flat WHERE individual_ref = 240276), 'New part data well updated in darwin flat');
SELECT ok(true = (SELECT with_parts FROM darwin_flat WHERE individual_ref = 240276), 'and with with_parts field well updated');
SELECT lives_ok('INSERT INTO specimen_parts (id, specimen_individual_ref, specimen_part) VALUES (240276, 240276, ''leg'')', 'Insertion of a new part for the same individual');
SELECT ok(2 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100001 AND individual_ref = 240276 AND with_parts = true), 'Creates well a new line');
SELECT ok(1 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100001 AND part_ref = 240276), '... and with good values');

-- Test removing parts interactions

SELECT lives_ok('DELETE FROM specimen_parts WHERE specimen_individual_ref = 240276', 'Parts well deleted for individual 240276');
SELECT ok(0 = (SELECT COUNT(*) FROM specimen_parts WHERE specimen_individual_ref = 240276), 'No more parts for individual 240276');
SELECT ok(false = (SELECT with_parts FROM specimen_individuals WHERE id = 240276), 'With parts field well updated in specimen_individuals');
SELECT ok(1 = (SELECT COUNT(*) from darwin_flat WHERE individual_ref = 240276), 'Nbr of corresponding records well updated in darwin_flat');
SELECT ok(false = (SELECT with_parts FROM darwin_flat WHERE individual_ref = 240276), 'With parts field well updated in darwin_flat');
SELECT ok(0 = (SELECT COALESCE(part_ref,0) FROM darwin_flat WHERE individual_ref = 240276), 'Part ref well removed');

-- Testing removing individuals with two parts linked deleted with cascade delete
INSERT INTO specimen_parts (id, specimen_individual_ref, specimen_part) VALUES (240275, 240276, 'specimen');
INSERT INTO specimen_parts (id, specimen_individual_ref, specimen_part) VALUES (240276, 240276, 'leg');
SELECT ok(2 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100001 AND individual_ref = 240276 AND with_parts = true), 'Creates well a new line');
SELECT ok(1 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100001 AND part_ref = 240276), '... and with good values');
SELECT lives_ok('DELETE FROM specimen_individuals WHERE id = 240276', 'Deleting individual 240276');
SELECT ok(1 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100001 AND with_individuals = true), 'One line remains');
SELECT ok(0 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100001 AND individual_ref = 240276), 'No more individual 240276');
SELECT ok(false = (SELECT DISTINCT with_parts FROM darwin_flat WHERE spec_ref = 100001), 'with parts set to false for specimen 100001');
INSERT INTO specimen_individuals (id, specimen_ref, type) VALUES (240276, 100001, 'paratype');
INSERT INTO specimen_parts (id, specimen_individual_ref, specimen_part) VALUES (240275, 240276, 'specimen');
INSERT INTO specimen_parts (id, specimen_individual_ref, specimen_part) VALUES (240276, 240276, 'leg');
SELECT lives_ok('DELETE FROM specimen_individuals', 'Deleting all individuals');
SELECT ok(1 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100001), 'Spec 100001 remaining in flat');
SELECT ok(false = (SELECT with_individuals FROM darwin_flat WHERE spec_ref = 100001), 'Deleting all individuals set well with_individuals to false');
SELECT ok(false = (SELECT with_parts FROM darwin_flat WHERE spec_ref = 100001), '...with_parts well set to false');
SELECT ok(0 = (SELECT COALESCE(part_ref,0) FROM darwin_flat WHERE spec_ref = 100001), '... and no more part_ref');

SELECT diag('Test now how db reacts by moving a part from one individual to an other');

INSERT INTO specimen_individuals (id, specimen_ref, type) VALUES (240275, 100001, 'holotype');
INSERT INTO specimen_individuals (id, specimen_ref, type) VALUES (240276, 100001, 'paratype');
INSERT INTO specimen_parts (id, specimen_individual_ref, specimen_part) VALUES (240275, 240276, 'specimen');
INSERT INTO specimen_parts (id, specimen_individual_ref, specimen_part) VALUES (240276, 240276, 'leg');

SELECT ok(3 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100001), 'We''ve got well 3 lines for specimen 100001');
SELECT lives_ok('UPDATE specimen_parts SET specimen_individual_ref = 240275, specimen_part = ''wing'' WHERE id = 240275', 'Move well part 240275 from individual 240276 to individual 240275');
SELECT ok(2 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100001), 'We''ve got now 2 lines for specimen 100001');
SELECT ok(1 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100001 AND individual_ref = 240275 AND part_ref = 240275), 'Only one with individual 240275');
SELECT ok(1 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100001 AND individual_ref = 240276 AND part_ref = 240276), 'and only one with individual 240276');

SELECT lives_ok('UPDATE specimen_parts SET specimen_individual_ref = 240275, specimen_part = ''foot'' WHERE id = 240276', 'Move well part 240276 from individual 240276 to individual 240275');
SELECT ok(3 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100001), 'We''ve got now 3 lines for specimen 100001');
SELECT ok(1 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100001 AND individual_ref = 240275 AND part_ref = 240275), 'Part 240275 is with individual 240275');
SELECT ok(1 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100001 AND individual_ref = 240275 AND part_ref = 240276), 'Part 240276 is with individual 240275');
SELECT ok(1 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100001 AND individual_ref = 240276 AND part_ref IS NULL), 'Individual 240276 has no parts');


SELECT lives_ok('UPDATE specimen_individuals SET specimen_ref = 100000, type = ''lectotype'' WHERE id = 240275', 'Move well individual 240275 from specimen 100001 to specimen 100000');
SELECT ok(1 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100001), 'We''ve got now 1 line for specimen 100001');
SELECT ok(2 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100000), 'and 2 lines for specimen 100000');
SELECT ok(1 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100000 AND individual_ref = 240275 AND part_ref = 240275), 'One per part');
SELECT ok(1 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100000 AND individual_ref = 240275 AND part_ref = 240276), 'One per part');

SELECT lives_ok('UPDATE specimen_individuals SET specimen_ref = 100000, type = ''paralectotype'' WHERE id = 240276', 'Move well individual 240276 from specimen 100001 to specimen 100000');
SELECT ok(1 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100001), 'We''ve got now 1 line for specimen 100001');
SELECT ok(3 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100000), 'and 3 lines for specimen 100000');
SELECT ok(1 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100000 AND individual_ref = 240275 AND part_ref = 240275), 'One per part');
SELECT ok(1 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100000 AND individual_ref = 240275 AND part_ref = 240276), 'One per part');
SELECT ok(1 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100000 AND individual_ref = 240276 AND part_ref IS NULL), 'One with part null');

SELECT diag('Test cascade delete of a specimen');

SELECT lives_ok('DELETE FROM specimens WHERE id = 100000', 'Delete seems to work');
SELECT ok (0 = (SELECT COUNT(*) FROM darwin_flat WHERE spec_ref = 100000), 'Effectively deleted');

SELECT * FROM finish();
ROLLBACK;
