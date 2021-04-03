<?php

-- // Update accjaopenbalances - 1 STEP-1

declare @whid int = 2;
-- set @whid = 2;

with cte as (
  select accjournalaccount_id, sum(debit) as tbebit, sum(credit) as tcredit
  from accjourpostdetails where warehouse_id = @whid
  group by accjournalaccount_id
)

--select * from cte;

update accjaopenbalances set debit = t2.tbebit, credit = t2.tcredit

from accjaopenbalances join (
  select * from cte
) as t2 on t2.accjournalaccount_id = accjaopenbalances.accaccjournalaccount_id where accjaopenbalances.warehouse_id = @whid 



-- // Update accjaopenbalances - 2 STEP-2

declare @whid int = 2;
-- set @whid = 2;

with cte as (
  select t3.id as id, t3.accaccjournalaccount_id as aid, 
  t3.opnbdebit, t3.opnbcredit,
  t3.debit, t3.credit,
  t3.clbdebit, t3.clbcredit
  from accjaopenbalances t3 where t3.warehouse_id = @whid
)

--select * from cte;

update accjaopenbalances set clbdebit = (t2.clbdebit + t2.debit ), credit = (t2.clbcredit + t2.credit )

from accjaopenbalances join (
  select * from cte
) as t2 on t2.id = accjaopenbalances.id where accjaopenbalances.warehouse_id = @whid 



-- // Trail Balance - 3 STEP-3
declare @whid int = 2;

with cte as  
(  
  select t1.accaccjournalaccount_id as aid,
  t1.accaccjournalaccount_id as root_id,

  t1.opnbdebit, t1.opnbcredit,
  t1.debit, t1.credit,
  t1.clbdebit, t1.clbcredit

  from accjaopenbalances t1 
  
  where t1.warehouse_id = @whid 
  union all  
  select t2.accaccjournalaccount_id as aid, cte.root_id,
  t2.opnbdebit, t2.opnbcredit,
  t2.debit, t2.credit,
  t2.clbdebit, t2.clbcredit
   
  from accjaopenbalances t2
    inner join cte on t2.parent_id = cte.aid where t2.warehouse_id = @whid 
)
--select * from cte;


select t3.id as id, 
t3.accaccjournalaccount_id as aid,t5.name, 

t3.opnbdebit, t3.opnbcredit,
t4.tdebit,t4.tcredit,t4.clbdebit,t4.clbcredit

from accjaopenbalances t3 

  join accjournalaccounts t5 on t5.id = t3.accaccjournalaccount_id
  inner join ( 
  
  select root_id, sum(debit) as tdebit, sum(credit) as tcredit,
  sum(clbdebit) as clbdebit, sum(clbcredit) as clbcredit
  from cte group by cte.root_id 

  ) as t4 on t3.accaccjournalaccount_id = t4.root_id  where t3.warehouse_id = @whid 
order by t3.parent_id asc option (maxrecursion 0)
