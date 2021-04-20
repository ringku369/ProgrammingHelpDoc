-- Example -SYNTEX - 1
CREATE TRIGGER trigger_name ON {table|view}  
[WITH ENCRYPTION|EXECUTE AS]  
{FOR|AFTER|INSTEAD OF} {[CREATE|ALTER|DROP|INSERT|UPDATE|DELETE ]}  
[NOT FOR REPLICATION]  
AS  
sql_statement [1...n ] 

-- Example -SYNTEX - 1


-- Example -1

CREATE OR ALTER TRIGGER ainstr_catfirsts ON catfirsts
AFTER INSERT 

AS BEGIN
 if(select name_en from inserted) = 'Category-4'
  Begin
    Return
  End

 insert into catseconds (branch_id,catfirst_id,name_en) values (9,2,'Subcategory-2')
END

DROP TRIGGER ainstr_catfirsts
-- Example -1




-- Example -2

CREATE OR ALTER TRIGGER ainstr_accjournalaccounts ON accjournalaccounts
AFTER INSERT 

AS BEGIN
 if(select name from inserted) = 'Fixed Asset'
  Begin
    update accjournalaccounts set astype = 1 where id =  (select top 1 id from inserted)
  End

  if(select name from inserted) = 'Current Asset'
  Begin
    update accjournalaccounts set astype = 2 where id =  (select top 1 id from inserted)
  End

  if(select astype from accjournalaccounts where id = (select parent_id from inserted)) = 1
  Begin
    update accjournalaccounts set astype = 1 where id =  (select id from inserted)
  End

  if(select astype from accjournalaccounts where id = (select parent_id from inserted)) = 2
  Begin
    update accjournalaccounts set astype = 2 where id =  (select id from inserted)
  End

END

DROP TRIGGER ainstr_accjournalaccounts
-- Example -2