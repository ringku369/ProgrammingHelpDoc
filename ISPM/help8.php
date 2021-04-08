<?php


-- Example -1

CREATE OR ALTER PROCEDURE TB_Stap_1 @wid int, @fdate datetime ,@tdate datetime
AS BEGIN
-- start code
declare @whid int = @wid;
declare @fdatev datetime = @fdate;
declare @tdatev datetime = @tdate;

--declare @whid int = 2;
--declare @fdate datetime = '2021-04-03';
--declare @tdate datetime = '2021-04-03';

update accjaopenbalances set debit = 0, credit = 0, clbdebit = 0, clbcredit = 0 where warehouse_id = @whid;

with cte1 as (
  select accjournalaccount_id, sum(debit) as tbebit, sum(credit) as tcredit
  from accjourpostdetails where warehouse_id = @whid and convert(varchar(10),vchdate, 121)  between  @fdatev and @tdatev
  group by accjournalaccount_id
)


update accjaopenbalances set debit = t2.tbebit, credit = t2.tcredit
from accjaopenbalances join (
  select * from cte1
) as t2 on t2.accjournalaccount_id = accjaopenbalances.accaccjournalaccount_id where accjaopenbalances.warehouse_id = @whid;

-- end code 




-- start code

-- cte_step-1
with cte2 as (
  select t3.id as id, t3.accaccjournalaccount_id as aid, 
  t3.opnbdebit, t3.opnbcredit,
  t3.debit, t3.credit,
  t3.clbdebit, t3.clbcredit
  from accjaopenbalances t3 where t3.accstatus = 1 and t3.warehouse_id = @whid
)
update accjaopenbalances set clbdebit = ((t2.opnbdebit) + (t2.debit - t2.credit)), clbcredit = 0
from accjaopenbalances join (
  select * from cte2
) as t2 on t2.id = accjaopenbalances.id where 

accjaopenbalances.accstatus = 1 and
accjaopenbalances.warehouse_id = @whid;
-- cte_step-1

-- cte_step-2
with cte3 as (
  select t3.id as id, t3.accaccjournalaccount_id as aid, 
  t3.opnbdebit, t3.opnbcredit,
  t3.debit, t3.credit,
  t3.clbdebit, t3.clbcredit
  from accjaopenbalances t3 where t3.accstatus = 2 and t3.warehouse_id = @whid
)
update accjaopenbalances set clbdebit = 0, 
clbcredit = ((t2.opnbcredit) + (t2.credit - t2.debit))
from accjaopenbalances join (
  select * from cte3
) as t2 on t2.id = accjaopenbalances.id where 

accjaopenbalances.accstatus = 2 and
accjaopenbalances.warehouse_id = @whid;
-- cte_step-2


-- cte_step-3
with cte4 as (
  select t3.id as id, t3.accaccjournalaccount_id as aid, 
  t3.opnbdebit, t3.opnbcredit,
  t3.debit, t3.credit,
  t3.clbdebit, t3.clbcredit
  from accjaopenbalances t3 where t3.accstatus = 3 and t3.warehouse_id = @whid
)
update accjaopenbalances set clbdebit = 0, 
clbcredit = ((t2.opnbcredit) + (t2.credit - t2.debit))
from accjaopenbalances join (
  select * from cte4
) as t2 on t2.id = accjaopenbalances.id where 

accjaopenbalances.accstatus = 3 and
accjaopenbalances.warehouse_id = @whid;
-- cte_step-3

-- cte_step-4
with cte5 as (
  select t3.id as id, t3.accaccjournalaccount_id as aid, 
  t3.opnbdebit, t3.opnbcredit,
  t3.debit, t3.credit,
  t3.clbdebit, t3.clbcredit
  from accjaopenbalances t3 where t3.accstatus = 4 and t3.warehouse_id = @whid
)
update accjaopenbalances set clbdebit = ((t2.opnbdebit) + (t2.debit - t2.credit)), clbcredit = 0
from accjaopenbalances join (
  select * from cte5
) as t2 on t2.id = accjaopenbalances.id where 

accjaopenbalances.accstatus = 4 and
accjaopenbalances.warehouse_id = @whid;
-- cte_step-4

-- end code


END



--Exec TB_Stap_1 @wid = 2, @fdate = '2021-04-03', @tdate = '2021-04-03';

--DROP PROCEDURE TB_Stap_1


-- Example -1





-- Example -2

CREATE OR ALTER PROCEDURE TB_Stap_2 @wid int
AS BEGIN

-- start code
declare @whid int = @wid;
with cte3 as  
(  
  select t1.accaccjournalaccount_id as aid,
  t1.accaccjournalaccount_id as root_id,

  t1.opnbdebit, t1.opnbcredit,
  t1.debit, t1.credit,
  t1.clbdebit, t1.clbcredit

  from accjaopenbalances t1 
  
  where t1.warehouse_id = @whid 
  union all  
  select t2.accaccjournalaccount_id as aid, cte3.root_id,
  t2.opnbdebit, t2.opnbcredit,
  t2.debit, t2.credit,
  t2.clbdebit, t2.clbcredit
   
  from accjaopenbalances t2
    inner join cte3 on t2.parent_id = cte3.aid where t2.warehouse_id = @whid 
)
--select * from cte3;


select t3.id as id, 
t3.accaccjournalaccount_id as aid,t5.name, 

t4.opnbdebit, t4.opnbcredit,
t4.tdebit as debit,t4.tcredit as credit,
t4.clbdebit as clbdebit, t4.clbcredit as clbcredit

from accjaopenbalances t3 

  join accjournalaccounts t5 on t5.id = t3.accaccjournalaccount_id
  inner join ( 
  
  select root_id,
  sum(opnbdebit) as opnbdebit, sum(opnbcredit) as opnbcredit, 
  sum(debit) as tdebit, sum(credit) as tcredit,
  sum(clbdebit) as clbdebit, sum(clbcredit) as clbcredit
  from cte3 group by cte3.root_id 

  ) as t4 on t3.accaccjournalaccount_id = t4.root_id  where t3.warehouse_id = @whid 
order by t3.accstatus,t3.parent_id asc option (maxrecursion 0)
-- end code 

END

--Exec TB_Stap_2 @wid = 2;

--DROP PROCEDURE TB_Stap_2

-- Example -2





-- Example -3

CREATE OR ALTER PROCEDURE TB_Stap_1_1 @wid int, @fdate datetime ,@tdate datetime
AS BEGIN
-- start code
declare @whid int = @wid;
declare @fdatev datetime = @fdate;
declare @tdatev datetime = @tdate;

--declare @whid int = 2;
--declare @fdate datetime = '2021-04-03';
--declare @tdate datetime = '2021-04-03';

update accjaopenbalances set debit = 0, credit = 0, clbdebit = 0, clbcredit = 0 where warehouse_id = @whid;

with cte1 as (
  select accjournalaccount_id, sum(debit) as tbebit, sum(credit) as tcredit
  from accjourpostdetails where warehouse_id = @whid and convert(varchar(10),vchdate, 121)  between  @fdatev and @tdatev
  group by accjournalaccount_id
)


update accjaopenbalances set debit = t2.tbebit, credit = t2.tcredit
from accjaopenbalances join (
  select * from cte1
) as t2 on t2.accjournalaccount_id = accjaopenbalances.accaccjournalaccount_id where accjaopenbalances.warehouse_id = @whid;

-- end code 




-- start code

-- cte_step-1
with cte2 as (
  select t3.id as id, t3.accaccjournalaccount_id as aid, 
  t3.opnbdebit, t3.opnbcredit,
  t3.debit, t3.credit,
  t3.clbdebit, t3.clbcredit
  from accjaopenbalances t3 where t3.accstatus = 1 and t3.warehouse_id = @whid
)
update accjaopenbalances set clbdebit = ((t2.opnbdebit) + (t2.debit - t2.credit)), clbcredit = 0
from accjaopenbalances join (
  select * from cte2
) as t2 on t2.id = accjaopenbalances.id where 

accjaopenbalances.accstatus = 1 and
accjaopenbalances.warehouse_id = @whid;
-- cte_step-1

-- cte_step-2
with cte3 as (
  select t3.id as id, t3.accaccjournalaccount_id as aid, 
  t3.opnbdebit, t3.opnbcredit,
  t3.debit, t3.credit,
  t3.clbdebit, t3.clbcredit
  from accjaopenbalances t3 where t3.accstatus = 2 and t3.warehouse_id = @whid
)
update accjaopenbalances set clbdebit = 0, 
clbcredit = ((t2.opnbcredit) + (t2.credit - t2.debit))
from accjaopenbalances join (
  select * from cte3
) as t2 on t2.id = accjaopenbalances.id where 

accjaopenbalances.accstatus = 2 and
accjaopenbalances.warehouse_id = @whid;
-- cte_step-2


-- cte_step-3
with cte4 as (
  select t3.id as id, t3.accaccjournalaccount_id as aid, 
  t3.opnbdebit, t3.opnbcredit,
  t3.debit, t3.credit,
  t3.clbdebit, t3.clbcredit
  from accjaopenbalances t3 where t3.accstatus = 3 and t3.warehouse_id = @whid
)
update accjaopenbalances set clbdebit = 0, 
clbcredit = ((t2.opnbcredit) + (t2.credit - t2.debit))
from accjaopenbalances join (
  select * from cte4
) as t2 on t2.id = accjaopenbalances.id where 

accjaopenbalances.accstatus = 3 and
accjaopenbalances.warehouse_id = @whid;
-- cte_step-3

-- cte_step-4
with cte5 as (
  select t3.id as id, t3.accaccjournalaccount_id as aid, 
  t3.opnbdebit, t3.opnbcredit,
  t3.debit, t3.credit,
  t3.clbdebit, t3.clbcredit
  from accjaopenbalances t3 where t3.accstatus = 4 and t3.warehouse_id = @whid
)
update accjaopenbalances set clbdebit = ((t2.opnbdebit) + (t2.debit - t2.credit)), clbcredit = 0
from accjaopenbalances join (
  select * from cte5
) as t2 on t2.id = accjaopenbalances.id where 

accjaopenbalances.accstatus = 4 and
accjaopenbalances.warehouse_id = @whid;
-- cte_step-4

-- end code


END



--Exec TB_Stap_1_1 @wid = 2, @fdate = '2021-04-03', @tdate = '2021-04-03';

--DROP PROCEDURE TB_Stap_1


-- Example -3






-- Example -4

CREATE OR ALTER PROCEDURE TB_Stap_2_2 @wid int
AS BEGIN

-- start code
declare @whid int = @wid;
with cte3 as  
(  
  select t1.accaccjournalaccount_id as aid,
  t1.accaccjournalaccount_id as root_id,

  t1.uopnbdebit, t1.uopnbcredit,
  t1.debit, t1.credit,
  t1.clbdebit, t1.clbcredit

  from accjaopenbalances t1 
  
  where t1.warehouse_id = @whid 
  union all  
  select t2.accaccjournalaccount_id as aid, cte3.root_id,
  t2.uopnbdebit, t2.uopnbcredit,
  t2.debit, t2.credit,
  t2.clbdebit, t2.clbcredit
   
  from accjaopenbalances t2
    inner join cte3 on t2.parent_id = cte3.aid where t2.warehouse_id = @whid 
)
--select * from cte3;


select t3.id as id, 
t3.accaccjournalaccount_id as aid,t5.name, 

t4.opnbdebit, t4.opnbcredit,
t4.tdebit as debit,t4.tcredit as credit,
t4.clbdebit as clbdebit, t4.clbcredit as clbcredit

from accjaopenbalances t3 

  join accjournalaccounts t5 on t5.id = t3.accaccjournalaccount_id
  inner join ( 
  
  select root_id,
  sum(uopnbdebit) as opnbdebit, sum(uopnbcredit) as opnbcredit, 
  sum(debit) as tdebit, sum(credit) as tcredit,
  sum(clbdebit) as clbdebit, sum(clbcredit) as clbcredit
  from cte3 group by cte3.root_id 

  ) as t4 on t3.accaccjournalaccount_id = t4.root_id  where t3.warehouse_id = @whid 
order by t3.accstatus,t3.parent_id asc option (maxrecursion 0)
-- end code 

END

--Exec TB_Stap_2_2 @wid = 2;

--DROP PROCEDURE TB_Stap_2_2

-- Example -4









-- Final Execution

Exec TB_Stap_1 @wid = 2, @fdate = '2021-04-03', @tdate = '2021-04-03';
Exec TB_Stap_1_1 @wid = 2, @fdate = '2021-04-03', @tdate = '2021-04-03';
Exec TB_Stap_2 @wid = 2;
Exec TB_Stap_2_2 @wid = 2;

-- Final Execution