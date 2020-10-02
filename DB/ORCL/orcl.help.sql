### To know grant-all-privileges 
#### https://www.oracletutorial.com/oracle-administration/oracle-grant-all-privileges-to-a-user/


TRUNCATE TABLE students;

CREATE TABLE students (
    id NUMBER (4) NOT NULL UNIQUE,
	name VARCHAR(128) NULL
);


CREATE TABLE students (

	id NUMBER (4) NOT NULL PRIMARY KEY,
	name VARCHAR(128) NULL
);


ALTER TABLE students;
MODIFY id NOT NULL PRIMARY KEY;

ALTER TABLE students
ADD created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE students
ADD updated_at TIMESTAMP DEFAULT NOW();




CREATE SEQUENCE AUTO_INCREMENT_SEQ START WITH 1;
CREATE SEQUENCE AUTO_INCREMENT_SEQ START WITH 1 MINVALUE 1 MAXVALUE 100000;


CREATE OR REPLACE TRIGGER STUDENTS_AUTO_INCREMENT 
BEFORE INSERT ON students 
FOR EACH ROW

BEGIN
  SELECT AUTO_INCREMENT_SEQ.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;


INSERT INTO students (name) VALUES  ('Saim');
INSERT INTO students (name) VALUES  ('Ringku');
INSERT INTO students (name) VALUES  ('Jibran');
INSERT INTO students (name) VALUES  ('Nipa');
INSERT INTO students (name) VALUES  ('Nico');



select * from students;

select id, name, TO_CHAR(created_at,'dd/mm/yyyy') as created_at from students;

select id, name, TO_CHAR(SYSDATE, 'MM-DD-YYYY HH12:MI:SS') AS today  from students;

select id, name, TO_CHAR(CURRENT_DATE, 'DD-MON-YYYY HH:MI:SS') AS today  from students;

select id, name, TO_CHAR(sysdate,'Day, ddth Month, yyyy') as today from students;




#### cmd >  
#
# sqlplus 
# system
# Oracle123
# 
#### sql > conn username/password;

show user;
select * from tab;
select username from all_users;


DROP USER RINGKU CASCADE;

#CREATE USER books_admin IDENTIFIED BY MyPassword;

CREATE USER RINGKU IDENTIFIED BY Oracle123;

CREATE USER MEGHNAHR IDENTIFIED BY Oracle123;


GRANT RESOURCE,
IMP_FULL_DATABASE,
BACKUP ANY TABLE,
CREATE SESSION, 
CREATE TABLE, 
CREATE VIEW, 
CREATE SEQUENCE, 
CREATE ANY SEQUENCE, 
CREATE ANY SYNONYM, 
CREATE ANY TRIGGER, 
CREATE ANY INDEX,                       
CREATE ANY INDEXTYPE,
CREATE TYPE,
CREATE ROLE,                            
CREATE ROLLBACK SEGMENT, 
CREATE PROCEDURE,
CREATE CLUSTER,
CREATE CUBE,
ALTER ANY TABLE,
ALTER ANY SEQUENCE, 
ALTER ANY TRIGGER, 
ALTER ANY INDEX,                       
ALTER ANY INDEXTYPE,
ALTER ANY TYPE,
ALTER ANY ROLE,                         
ALTER ROLLBACK SEGMENT, 
ALTER ANY PROCEDURE,
ALTER ANY CLUSTER,
ALTER ANY CUBE,
DROP ANY TABLE, 
DROP ANY VIEW, 
DROP ANY SEQUENCE, 
DROP ANY SYNONYM, 
DROP ANY TRIGGER, 
DROP ANY INDEX,                       
DROP ANY INDEXTYPE,
DROP ANY TYPE,
DROP ANY ROLE,                            
DROP ROLLBACK SEGMENT, 
DROP ANY PROCEDURE,
DROP ANY CLUSTER,
DROP ANY CUBE,
SELECT ANY TABLE, 
SELECT ANY SEQUENCE, 
SELECT ANY TRANSACTION,
UPDATE ANY TABLE TO RINGKU;


#### cmd >
EXP RINGKU/Oracle123@ORCL FILE=E:\Orcdb\ringku.dmp LOG=E:\Orcdb\ringku.log;
IMP RINGKU/Oracle123@ORCL FILE=E:\Orcdb\ringku.dmp LOG=E:\Orcdb\ringku.log FULL=Y;

exp system/manager file=emp.dmp log=emp_exp.log full=y
imp system/manager file=emp.dmp log=emp_imp.log full=y





EXP MEGHNAHR/meghnahr321@TESTDB FILE=F:\hrback\meghnahr.dmp LOG=F:\hrback\meghnahr.log;

IMP MEGHNAHR/Oracle123@ORCL FILE=F:\hrback\meghnahr.dmp LOG=F:\hrback\meghnahr.log FULL=Y;


# 180.92.224.141 / testdb / meghnahr/meghnahr321
<add key="ConnectionString2" value="user id=meghnahr;password=meghnahr321; data source=TESTDB;PERSIST SECURITY INFO=True;Connect Timeout=2000;  Max Pool Size=2000"/>
