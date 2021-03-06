\unset ECHO
\i unit_launch.sql
SELECT plan(18);

insert into people (id, db_people_type, is_physical,family_name, given_name, birth_date, gender,end_date)
 VALUES (3,6, true, 'Zé Doe', 'Jo-zé', DATE 'June 20, 1989', 'M', DEFAULT);

SELECT ok( 'Zé Doe Jo-zé' = (SELECT formated_name FROM people WHERE id=3),'formated_name composed');


UPDATE people SET gender='F' WHERE id=3;

SELECT ok( 'Zé Doe Jo-zé' = (SELECT formated_name FROM people WHERE id=3),'formated_name composed on changed gender');

UPDATE people SET title = 'Dr' ,gender='F' WHERE id=3;
SELECT ok( 'Zé Doe Jo-zé (Dr)' = (SELECT formated_name FROM people WHERE id=3),'formated_name composed on changed gender and title');

UPDATE people SET family_name = 'Van piéperzééél' WHERE id=3;
SELECT ok( 'Van piéperzééél Jo-zé (Dr)' = (SELECT formated_name FROM people WHERE id=3),'formated_name composed on changed name');
SELECT ok( 'vanpieperzeeeljozedr' = (SELECT formated_name_indexed FROM people WHERE id=3),'formated_name_indexed composed');
SELECT ok( to_tsvector('simple', 'Van piéperzééél Jo-zé (Dr)') = (SELECT formated_name_ts FROM people WHERE id=3),'formated_name_ts composed');


insert into users (id, is_physical,family_name, given_name, birth_date, gender)
 VALUES (3,true, 'Zé Doe', 'Jo-zé', DATE 'June 20, 1989', 'M');

SELECT ok( 'Zé Doe Jo-zé' = (SELECT formated_name FROM users WHERE id=3),'formated_name composed');


UPDATE users SET gender='F' WHERE id=3;

SELECT ok( 'Zé Doe Jo-zé' = (SELECT formated_name FROM users WHERE id=3),'formated_name composed on changed gender');

UPDATE users SET title = 'Dr' ,gender='F' WHERE id=3;
SELECT ok( 'Zé Doe Jo-zé (Dr)' = (SELECT formated_name FROM users WHERE id=3),'formated_name composed on changed gender and title');

UPDATE users SET family_name = 'Van piéperzééél' WHERE id=3;
SELECT ok( 'Van piéperzééél Jo-zé (Dr)' = (SELECT formated_name FROM users WHERE id=3),'formated_name composed on changed name');
SELECT ok( 'vanpieperzeeeljozedr' = (SELECT formated_name_indexed FROM users WHERE id=3),'formated_name_indexed composed');
SELECT ok( to_tsvector('simple', 'Van piéperzééél Jo-zé (Dr)') = (SELECT formated_name_ts FROM users WHERE id=3),'formated_name_ts composed');


insert into people (id, is_physical, family_name, birth_date, end_date ) VALUES
(10, false, 'The Management Unit of the North Sea Mathematical Models',DATE 'January 8, 1830', DEFAULT);

SELECT ok( 'The Management Unit of the North Sea Mathematical Models' = (SELECT formated_name FROM people WHERE id=10),'formated_name composed on changed name');
SELECT ok( 'themanagementunitofthenorthseamathemati' = (SELECT formated_name_indexed FROM people WHERE id=10),'formated_name_indexed composed');
SELECT ok( '' = (SELECT title FROM people WHERE id=10),'title is empty');

SELECT ok('north' = (SELECT word FROM words where referenced_relation = 'people' AND field_name='formated_name_ts' AND word='north'), 'North was added to word table');
SELECT ok('models' = (SELECT word FROM words where referenced_relation = 'people' AND field_name='formated_name_ts' AND word='models'), 'model was added to word table');

UPDATE people SET title='Mr' WHERE id=10;

SELECT ok( 'Mr' = (SELECT title FROM people WHERE id=10),'title is still empty');

SELECT * FROM finish();
ROLLBACK;
