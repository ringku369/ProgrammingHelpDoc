### To know grant-all-privileges 
#### https://www.oracletutorial.com/oracle-administration/oracle-grant-all-privileges-to-a-user/


TRUNCATE TABLE students;

CREATE TABLE students (
    id NUMBER (4) NOT NULL UNIQUE,
	name VARCHAR(128) NULL,

);


CREATE TABLE users (

	id NUMBER (4) NOT NULL PRIMARY KEY,
	name VARCHAR(128) NULL,
	active_date DATE DEFAULT SYSDATE NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE cities (

	id NUMBER (4) NOT NULL PRIMARY KEY,
	name VARCHAR(128) NULL,
	code VARCHAR(128) NULL,
	active_date DATE DEFAULT SYSDATE NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



ALTER TABLE students;
MODIFY id NOT NULL PRIMARY KEY;

ALTER TABLE students
ADD created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE students
ADD updated_at TIMESTAMP DEFAULT NOW();


ALTER TABLE students
ADD active_date DATE DEFAULT SYSDATE NOT NULL;



INSERT INTO students (name) VALUES  ('Saim');
INSERT INTO students (name) VALUES  ('Ringku');
INSERT INTO students (name) VALUES  ('Jibran');
INSERT INTO students (name) VALUES  ('Nipa');
INSERT INTO students (name) VALUES  ('Nico');



select * from students;

select id, name, TO_CHAR(active_date,'MM-DD-YYYY') as created_at from students;


select id, name, TO_CHAR(created_at,'dd/mm/yyyy') as created_at from students;

select id, name, TO_CHAR(SYSDATE, 'MM-DD-YYYY HH12:MI:SS') AS today  from students;

select id, name, TO_CHAR(CURRENT_DATE, 'DD-MON-YYYY HH:MI:SS') AS today  from students;

select id, name, TO_CHAR(sysdate,'Day, ddth Month, yyyy') as today from students;

