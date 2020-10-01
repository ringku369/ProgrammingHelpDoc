TRUNCATE TABLE STUDENTS;

CREATE TABLE STUDENTS (

	id NUMBER (4) NOT NULL,
	name VARCHAR(128) NULL
);


CREATE SEQUENCE AUTO_INCREMENT_SEQ START WITH 1;

CREATE OR REPLACE TRIGGER STUDENTS_AUTO_INCREMENT 
BEFORE INSERT ON STUDENTS 
FOR EACH ROW

BEGIN
  SELECT AUTO_INCREMENT_SEQ.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;


select * from STUDENTS;

INSERT INTO STUDENTS (NAME) VALUES  ('Saim');
INSERT INTO STUDENTS (NAME) VALUES  ('Ringku');
INSERT INTO STUDENTS (NAME) VALUES  ('Jibran');
INSERT INTO STUDENTS (NAME) VALUES  ('Nipa');
INSERT INTO STUDENTS (NAME) VALUES  ('Nico');



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


GRANT 
RESOURCE,
CREATE SESSION, 
CREATE TABLE, 
CREATE VIEW, 
CREATE SEQUENCE, 
CREATE ANY SEQUENCE, 
CREATE ANY SYNONYM, 
CREATE ANY TRIGGER, 
CREATE PROCEDURE TO RINGKU;


#### cmd >
EXP RINGKU/Oracle123@ORCL FILE=E:\Orcdb\ringku.dmp LOG=E:\Orcdb\ringku.log;
IMP RINGKU/Oracle123@ORCL FILE=E:\Orcdb\ringku.dmp LOG=E:\Orcdb\ringku.log FULL=Y;

exp system/manager file=emp.dmp log=emp_exp.log full=y
imp system/manager file=emp.dmp log=emp_imp.log full=y



EXP MEGHNAHR/meghnahr321@TESTDB FILE=F:\hrback\meghnahr.dmp LOG=F:\hrback\meghnahr.log;



<add key="ConnectionString2" value="user id=meghnahr;password=meghnahr321; data source=TESTDB;PERSIST SECURITY INFO=True;Connect Timeout=2000;  Max Pool Size=2000"/>
