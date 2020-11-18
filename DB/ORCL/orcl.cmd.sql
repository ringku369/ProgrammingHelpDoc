
## Server PC Password : Aa123
## Teamviewer Username : 459391432 Password : Aa123123


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

select username, created from all_users where username=hr;

conn username/password;


DROP USER RINGKU CASCADE;

#CREATE USER books_admin IDENTIFIED BY MyPassword;

CREATE USER RINGKU IDENTIFIED BY Oracle123;

CREATE USER MEGHNAHR IDENTIFIED BY Oracle123;

/*create user MEGHNAHR identified by Oracle123 default tablespace MEGHNAHR 
	quota unlimited on MEGHNAHR;

grant connect, create session, imp_full_database to MEGHNAHR;
imp MEGHNAHR/Oracle123@ORCL file=<filename>.dmp log=<filename>.log full=y;

imp <username>/<password>@<hostname> file=<filename>.dmp log=<filename>.log full=y;*/

GRANT RESOURCE, CONNECT,
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
UPDATE ANY TABLE TO MEGHNAHR;


#### cmd >
EXP RINGKU/Oracle123@ORCL FILE=E:\Orcdb\ringku.dmp LOG=E:\Orcdb\ringku.log FULL=Y;
IMP RINGKU/Oracle123@ORCL FILE=E:\Orcdb\ringku.dmp LOG=E:\Orcdb\ringku.log FULL=Y;

EXP RINGKU/Oracle123@ORCL FILE=E:\Orcdb\ringku.dmp LOG=E:\Orcdb\db.log;
IMP JAHID/Oracle123@ORCL FILE=E:\Orcdb\ringku.dmp LOG=E:\Orcdb\db.log FULL=Y;



exp system/manager file=emp.dmp log=emp_exp.log full=y
imp system/manager file=emp.dmp log=emp_imp.log full=y





EXP MEGHNAHR/meghnahr321@TESTDB FILE=F:\hrback\meghnahr.dmp LOG=F:\hrback\meghnahr.log;

IMP MEGHNAHR/Oracle123@ORCL FILE=E:\Orcdb\meghnahr.dmp LOG=E:\Orcdb\meghnahr.log FULL=Y;

### For export fulldatabase whith expdp command
set oracle_sid=orcl
echo %oracle_sid%

sqlplus / as sysdba

create directory orcl_full as 'E:\Orcdb\Data Pump\Full Export'
grant read,write on directory orcl_full to hr;
grant datapump_exp_full_database to hr;
expdp hr/Oracle123@orcl directory=orcl_full dumpfile=orclfull.dmp logfile=full_exp.log full=y


## For export schemas expdp command
set oracle_sid=testdb
echo %oracle_sid%

sqlplus / as sysdba

create directory exp_schema as 'E:\Orcdb\Data Pump\Schema Export';
grant read,write on directory exp_schema to hr;
grant datapump_exp_full_database to hr;
expdp hr/Oracle123@testdb directory=exp_schema dumpfile=schema.dmp logfile=schema_exp.log schemas=meghnahr


## For import schemas impdp command
create directory exp_schema as 'E:\Orcdb\Data Pump\Schema Export';
grant read,write on directory exp_schema to system;
grant datapump_imp_full_database to system;
impdp system/Oracle123@testdb directory=exp_schema dumpfile=schema.dmp logfile=schema_exp.log schemas=meghnahr






# 180.92.224.141 / testdb / meghnahr/meghnahr321
<add key="ConnectionString2" value="user id=meghnahr;password=meghnahr321; data source=TESTDB;PERSIST SECURITY INFO=True;Connect Timeout=2000;  Max Pool Size=2000"/>


## To change remote access 
## D:\app\R\product\11.2.0\dbhome_1\NETWORK\ADMIN/listener.ora
(ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.0.120)(PORT = 1521))

## To restart oracle service
# run > services.msc

