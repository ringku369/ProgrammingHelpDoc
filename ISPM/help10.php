<?php


-- Example - TB_Step_1

ALTER   PROCEDURE [dbo].[TB_Step_1] @bid int, @fdate datetime ,@tdate datetime
AS BEGIN
-- start code
declare @brid int = @bid;
declare @fdatev datetime = @fdate;
declare @tdatev datetime = @tdate;

--declare @brid int = 2;
--declare @fdate datetime = '2021-04-03';
--declare @tdate datetime = '2021-04-03';

update accjaopenbalances set uopnbdebit = 0, uopnbcredit = 0, debit = 0, credit = 0, clbdebit = 0, clbcredit = 0 where branch_id = @brid;

with cte1 as (
  select accjournalaccount_id, sum(debit) as tbebit, sum(credit) as tcredit
  from accjourpostdetails where branch_id = @brid and convert(varchar(10),vchdate, 121)  between  @fdatev and @tdatev
  group by accjournalaccount_id
)


update accjaopenbalances set debit = t2.tbebit, credit = t2.tcredit
from accjaopenbalances join (
  select * from cte1
) as t2 on t2.accjournalaccount_id = accjaopenbalances.accjournalaccount_id where accjaopenbalances.branch_id = @brid;

-- end code 




-- start code

-- cte_step-1
with cte2 as (
  select t3.id as id, t3.accjournalaccount_id as aid, 
  t3.opnbdebit, t3.opnbcredit,
  t3.debit, t3.credit,
  t3.clbdebit, t3.clbcredit
  from accjaopenbalances t3 where t3.accstatus = 1 and t3.branch_id = @brid
)
update accjaopenbalances set clbdebit = ((t2.opnbdebit) + (t2.debit - t2.credit)), clbcredit = 0
from accjaopenbalances join (
  select * from cte2
) as t2 on t2.id = accjaopenbalances.id where 

accjaopenbalances.accstatus = 1 and
accjaopenbalances.branch_id = @brid;
-- cte_step-1

-- cte_step-2
with cte3 as (
  select t3.id as id, t3.accjournalaccount_id as aid, 
  t3.opnbdebit, t3.opnbcredit,
  t3.debit, t3.credit,
  t3.clbdebit, t3.clbcredit
  from accjaopenbalances t3 where t3.accstatus = 2 and t3.branch_id = @brid
)
update accjaopenbalances set clbdebit = 0, 
clbcredit = ((t2.opnbcredit) + (t2.credit - t2.debit))
from accjaopenbalances join (
  select * from cte3
) as t2 on t2.id = accjaopenbalances.id where 

accjaopenbalances.accstatus = 2 and
accjaopenbalances.branch_id = @brid;
-- cte_step-2


-- cte_step-3
with cte4 as (
  select t3.id as id, t3.accjournalaccount_id as aid, 
  t3.opnbdebit, t3.opnbcredit,
  t3.debit, t3.credit,
  t3.clbdebit, t3.clbcredit
  from accjaopenbalances t3 where t3.accstatus = 3 and t3.branch_id = @brid
)
update accjaopenbalances set clbdebit = 0, 
clbcredit = ((t2.opnbcredit) + (t2.credit - t2.debit))
from accjaopenbalances join (
  select * from cte4
) as t2 on t2.id = accjaopenbalances.id where 

accjaopenbalances.accstatus = 3 and
accjaopenbalances.branch_id = @brid;
-- cte_step-3

-- cte_step-4
with cte5 as (
  select t3.id as id, t3.accjournalaccount_id as aid, 
  t3.opnbdebit, t3.opnbcredit,
  t3.debit, t3.credit,
  t3.clbdebit, t3.clbcredit
  from accjaopenbalances t3 where t3.accstatus = 4 and t3.branch_id = @brid
)
update accjaopenbalances set clbdebit = ((t2.opnbdebit) + (t2.debit - t2.credit)), clbcredit = 0
from accjaopenbalances join (
  select * from cte5
) as t2 on t2.id = accjaopenbalances.id where 

accjaopenbalances.accstatus = 4 and
accjaopenbalances.branch_id = @brid;
-- cte_step-4

-- end code


END



--Exec TB_Step_1 @bid = 2, @fdate = '2021-04-03', @tdate = '2021-04-03';

--DROP PROCEDURE TB_Step_1

-- Example - TB_Step_1






-- Example - TB_Step_10

CREATE OR ALTER PROCEDURE [dbo].[TB_Step_10] @bid int
AS BEGIN

-- start code
declare @brid int = @bid;
--declare @brid int = 9;

update accjournalaccounts set uopnbdebit = 0, uopnbcredit = 0, debit = 0, credit = 0, clbdebit = 0, clbcredit = 0 where branch_id = @brid;

with cte as (
  select accjournalaccount_id, sum(opnbdebit) as topnbdebit, sum(opnbcredit) as topnbcredit,sum(uopnbdebit) as tuopnbdebit, 
  sum(uopnbcredit) as tuopnbcredit,sum(debit) as tdebit, sum(credit) as tcredit,sum(clbdebit) as tclbdebit, 
  sum(clbcredit) as tclbcredit from accjaopenbalances where branch_id = @brid group by accjournalaccount_id
)
update accjournalaccounts set opnbdebit = t2.topnbdebit, opnbcredit = t2.topnbcredit, 
 uopnbdebit = t2.tuopnbdebit, uopnbcredit = t2.tuopnbcredit, debit = t2.tdebit, credit = t2.tcredit, 
 clbdebit = t2.tclbdebit, clbcredit = t2.tclbcredit
from accjournalaccounts join (
  select * from cte
) as t2 on t2.accjournalaccount_id = accjournalaccounts.id where accjournalaccounts.branch_id = @brid;

END

--Exec TB_Step_10 @bid = 2;

--DROP PROCEDURE TB_Step_10

-- Example - TB_Step_10







