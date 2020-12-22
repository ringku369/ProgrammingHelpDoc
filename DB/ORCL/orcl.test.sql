set oracle_sid=testdb
echo %oracle_sid%

sqlplus / as sysdba


create directory exp_table as 'E:\Orcdb\Data Pump\Table Export';
grant read,write on directory exp_table to meghnahr;
grant datapump_exp_full_database to meghnahr;

expdp  meghnahr/meghnahr321@testdb  PARFILE='E:\Orcdb\Data Pump\exp_employee_table.par';

