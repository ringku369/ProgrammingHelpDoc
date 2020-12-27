180.92.224.141
## Server PC Password : Aa123
## Teamviewer Username : 459391432 Password : Aa123123


#### cmd >  
#
# sqlplus 
# system
# Oracle123
# 
#### sql > conn username/password;


set oracle_sid=orcl
echo %oracle_sid%

sqlplus / as sysdba


set oracle_sid=testdb
echo %oracle_sid%

sqlplus / as sysdba


show user;
select * from tab;
select username from all_users;


#Tablespace

select name from v$datafile;
select name from v$tablespace;
select tablespace_name from dba_tablespaces;

SELECT  FILE_NAME, BLOCKS, TABLESPACE_NAME, FILE_SIZE FROM DBA_DATA_FILES;

SELECT  FILE_NAME, BLOCKS, TABLESPACE_NAME FROM DBA_DATA_FILES WHERE TABLESPACE_NAME = 'USERS';
D:\APP\R\ORADATA\ORCL\USERS01.DBF

D:\APP\R\ORADATA\ORCL\EXAMPLE01.DBF

F:\11GR2\APP\ADMINISTRATOR\ORADATA\TESTDB\MEGHNA_DEVADM.DBF


CREATE TABLESPACE MEGHNAACCOUNTS DATAFILE 'D:\APP\R\ORADATA\ORCL\MEGHNAACCOUNTS01.DBF' SIZE 200M AUTOEXTEND ON; 


CREATE TABLESPACE MEGHNAACCOUNTS DATAFILE 'F:\11GR2\APP\ADMINISTRATOR\ORADATA\TESTDB\MEGHNAACCOUNTS.DBF' SIZE 200M AUTOEXTEND ON;

ALTER TABLESPACE MEGHNAACCOUNTS OFFLINE;
DROP TABLESPACE MEGHNAACCOUNTS;


CREATE USER MEGHNAACCOUNTS IDENTIFIED BY Oracle123 DEFAULT TABLESPACE MEGHNAACCOUNTS TEMPORARY TABLESPACE TEMP QUOTA 200M on MEGHNAACCOUNTS;

CREATE USER MEGHNAACCOUNTS IDENTIFIED BY meghnaaccounts321 DEFAULT TABLESPACE MEGHNAACCOUNTS TEMPORARY TABLESPACE TEMP QUOTA 200M on MEGHNAACCOUNTS;

#Tablespace




select username,default_tablespace from dba_users where username='MEGHNAACCOUNTS';
select username,temporary_tablespace, default_tablespace, account_status from dba_users where username='MEGHNAACCOUNTS';
select username,account_status from dba_users where username='MEGHNAACCOUNTS';


select username,temporary_tablespace, default_tablespace, account_status from dba_users where username='MEGHNA_ACCOUNTS';

SELECT TABLESPACE_NAME "TABLESPACE", EXTENT_MANAGEMENT,FORCE_LOGGING, BLOCK_SIZE, SEGMENT_SPACE_MANAGEMENT FROM DBA_TABLESPACES;


conn username/password;
conn meghnaaccounts/meghnaaccounts321;


DROP USER RINGKU CASCADE;
DROP USER MEGHNAHR CASCADE;
DROP USER MEGHNAACCOUNTS CASCADE;

#CREATE USER books_admin IDENTIFIED BY MyPassword;

CREATE USER RINGKU IDENTIFIED BY Oracle123;

CREATE USER MEGHNAHR IDENTIFIED BY Oracle123;

CREATE USER MEGHNAACCOUNTS IDENTIFIED BY meghnaaccounts321;

/*create user MEGHNAHR identified by Oracle123 default tablespace MEGHNAHR 
	quota unlimited on MEGHNAHR;

grant connect, create session, imp_full_database to MEGHNAHR;
imp MEGHNAHR/Oracle123@ORCL file=<filename>.dmp log=<filename>.log full=y;

imp <username>/<password>@<hostname> file=<filename>.dmp log=<filename>.log full=y;*/

CREATE USER MEGHNAHR IDENTIFIED BY Oracle123 DEFAULT TABLESPACE MEGHNAHR TEMPORARY TABLESPACE TEMP QUOTA 20000M on USERS;

CREATE USER MEGHNAACCOUNTS IDENTIFIED BY Oracle123 DEFAULT TABLESPACE MEGHNAACCOUNTS TEMPORARY TABLESPACE TEMP QUOTA 200M on MEGHNAACCOUNTS;


CREATE tablespace maccouts


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
UPDATE ANY TABLE TO MEGHNAACCOUNTS;


#### cmd >
EXP RINGKU/Oracle123@ORCL FILE=E:\Orcdb\ringku.dmp LOG=E:\Orcdb\ringku.log FULL=Y;
IMP RINGKU/Oracle123@ORCL FILE=E:\Orcdb\ringku.dmp LOG=E:\Orcdb\ringku.log FULL=Y;

EXP RINGKU/Oracle123@ORCL FILE=E:\Orcdb\ringku.dmp LOG=E:\Orcdb\db.log;
IMP JAHID/Oracle123@ORCL FILE=E:\Orcdb\ringku.dmp LOG=E:\Orcdb\db.log FULL=Y;



exp system/manager file=emp.dmp log=emp_exp.log full=y
imp system/manager file=emp.dmp log=emp_imp.log full=y


EXP meghnahr/Oracle123@ORCL FILE=E:\Orcdb\district.dmp LOG=E:\Orcdb\district.log tables=(district);

EXP meghnahr/meghnahr321@TESTDB FILE=E:\Orcdb\employee.dmp LOG=E:\Orcdb\employee.log tables=employee;




EXP MEGHNAHR/meghnahr321@TESTDB FILE=F:\hrback\meghnahr.dmp LOG=F:\hrback\meghnahr.log;

IMP MEGHNAHR/Oracle123@TESTDB FILE=E:\Orcdb\meghnahr.dmp LOG=E:\Orcdb\meghnahr.log FULL=Y;

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

impdp system/Oracle123@testdb directory=exp_schema dumpfile=meghnahr.dmp logfile=meghnahr.log schemas=meghnahr

impdp system/Oracle123@testdb directory=exp_schema dumpfile=full.dmp logfile=full.log full=y;






# 180.92.224.141 / testdb / meghnahr/meghnahr321
<add key="ConnectionString2" value="user id=meghnahr;password=meghnahr321; data source=TESTDB;PERSIST SECURITY INFO=True;Connect Timeout=2000;  Max Pool Size=2000"/>


## To change remote access 
## D:\app\R\product\11.2.0\dbhome_1\NETWORK\ADMIN/listener.ora
(ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.0.120)(PORT = 1521))

## To restart oracle service
# run > services.msc

imp help=y

D:\app\R/admin/testdb/dpdump/

11.2.0.1.0
11.2.0.3.0


### For export tablespace whith expdp command

set oracle_sid=testdb
echo %oracle_sid%

sqlplus / as sysdba
SQL>  SELECT   name   FROM   v$tablespace;

create directory exp_tblsp as 'E:\Orcdb\Data Pump\Tablespace Export';
grant read,write on directory exp_tblsp to hr;
grant datapump_exp_full_database to hr;

expdp hr/hr@ORCL  DIRECTORY = exp_tblsp  DUMPFILE = tablespace.dmp  LOGFILE = tblsp_log.log 
 TABLESPACES = USERS,EXAMPLE;


### For export tables whith expdp command

set oracle_sid=orcl
echo %oracle_sid%

sqlplus / as sysdba
SELECT   name   FROM   v$tablespace;

create directory exp_table as 'E:\Orcdb\Data Pump\Table Export';
grant read,write on directory exp_table to meghnahr;
grant datapump_exp_full_database to meghnahr;
grant EXP_FULL_DATABASE to meghnahr;

expdp meghnahr/Oracle123@ORCL PARFILE='E:\table.par';

expdp meghnahr/Oracle123@ORCL DIRECTORY=exp_table DUMPFILE=dump_file_name.dmp LOGFILE=log_file_name.log TABLES='"district"'

expdp system/Oracle123@ORCL directory=exp_table dumpfile=dump_help.dmp logfile=log_help.log tables=system.'"HELP"';

expdp meghnahr/Oracle123@ORCL directory=exp_table dumpfile=dump_help.dmp logfile=log_help.log tables='district' partition_options=merge;


