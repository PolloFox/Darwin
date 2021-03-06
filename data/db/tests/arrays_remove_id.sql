\unset ECHO
\i unit_launch.sql
SELECT plan(7);

select diag('Find in array');
select ok(1 = fct_array_find('aa,bb,cc,dd','aa'::text), 'Trying with a string as table');
select ok(3 = fct_array_find('aa,bb,cc,dd','cc'::text), 'try more elements');
select ok(fct_array_find('a,b,c,d','ee'::text) is null, 'try unkown elements');
select ok(2 = fct_array_find(ARRAY['aa','bb','cc','dd'],'bb'::text), 'try with array');

SELECT diag('Remove a people');

UPDATE people SET db_people_type = 6 WHERE id=2;
UPDATE people SET db_people_type = 6 WHERE id=1;
INSERT INTO taxonomy (id, name, level_ref) VALUES (1, 'Méàleis Gùbularis&', 1);

insert into people (id, db_people_type, is_physical, formated_name, formated_name_indexed, formated_name_ts, family_name, given_name, birth_date, gender, end_date) VALUES (3,6, true, 'sdf', 'doesfdjohn', to_tsvector('sd'), 'qsd', 'qsd', DATE 'June 20, 1989', 'M', DEFAULT);
insert into people (id,db_people_type, is_physical, formated_name, formated_name_indexed, formated_name_ts, family_name, given_name, birth_date, gender, end_date) VALUES (4,6, true, 'Doe Jsssohn', 'sssss', to_tsvector('Doe qsdqsd'), 'Dssoe', 'Johdn', DATE 'June 20, 1979', 'M', DEFAULT);
insert into people (id,db_people_type, is_physical, formated_name, family_name, given_name, birth_date, gender) VALUES (5,6, true, 'd f', 'sssvfddss', 'f', DATE 'June 20, 1979', 'M');
INSERT INTO catalogue_people (id,referenced_relation, record_id, people_type, order_by, people_ref) VALUES (5,'taxonomy', 0 ,'expertise', 0 , 3);

INSERT INTO catalogue_people (id,referenced_relation, record_id,people_type,order_by, people_ref)
 VALUES
(7, 'catalogue_people', 5, 'defined_by',1,5),
(8, 'catalogue_people', 5, 'defined_by',2,4),
(9, 'catalogue_people', 5, 'defined_by',3,3);

SELECT ok(array[5,4,3] = array(SELECT people_ref FROM catalogue_people WHERE referenced_relation = 'catalogue_people' AND record_id = 5 ORDER BY order_by),'Check if the array is well defined');

DELETE FROM catalogue_people WHERE id = 7;

SELECT ok(array[4,3] = array(SELECT people_ref FROM catalogue_people WHERE referenced_relation = 'catalogue_people' AND record_id = 5 ORDER BY order_by),'Check if the persone who define is deleted');


DELETE FROM people WHERE id>2;
SELECT ok( 0 = (select count(*) from catalogue_people) ,'Check if they are all removed');

SELECT * FROM finish();
ROLLBACK;
