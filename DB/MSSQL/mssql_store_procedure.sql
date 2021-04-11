-- Example -1

CREATE OR ALTER PROCEDURE GetData @wid int

AS BEGIN
	declare @whid int = @wid;
	with cte as (
		select * from accjaopenbalances where warehouse_id = @whid
	)
	select * from cte;
END

Exec GetData @wid = 2;

DROP PROCEDURE GetData

-- Example -1




-- Example -2

CREATE OR ALTER PROCEDURE TB_Stap_1 @wid int
AS BEGIN
-- start code
declare @whid int = @wid;
with cte1 as (
  select accjournalaccount_id, sum(debit) as tbebit, sum(credit) as tcredit
  from accjourpostdetails where warehouse_id = @whid
  group by accjournalaccount_id
)
update accjaopenbalances set debit = t2.tbebit, credit = t2.tcredit
from accjaopenbalances join (
  select * from cte1
) as t2 on t2.accjournalaccount_id = accjaopenbalances.accjournalaccount_id where accjaopenbalances.warehouse_id = @whid 

-- end code	

-- start code
update accjaopenbalances set clbdebit = 0, clbcredit = 0 where warehouse_id = @whid;
with cte2 as (
  select t3.id as id, t3.accjournalaccount_id as aid, 
  t3.opnbdebit, t3.opnbcredit,
  t3.debit, t3.credit,
  t3.clbdebit, t3.clbcredit
  from accjaopenbalances t3 where t3.warehouse_id = @whid
)
update accjaopenbalances set clbdebit = (t2.clbdebit + t2.debit ), clbcredit = (t2.clbcredit + t2.credit )
from accjaopenbalances join (
  select * from cte2
) as t2 on t2.id = accjaopenbalances.id where accjaopenbalances.warehouse_id = @whid 
-- end code

END

Exec TB_Stap_1 @wid = 2;

DROP PROCEDURE TB_Stap_1

-- Example -2