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

CREATE OR ALTER PROCEDURE GetData @wid int

AS BEGIN

-- inserting multiple row example - 1
insert into proavamounts (product_id,branch_id,price) 
select t1.id as product_id, t1.branch_id as branch_id, t1.caprice
from products as t1

-- inserting multiple row example - 1
insert into vreturndetails (sale_id,saledetail_id) 
select t1.id as sale_id, t2.id as saledetails_id
from sales as t1 join saledetails as t2 on t2.sale_id = t1.id where t1.id = 17

END

Exec GetData @wid = 2;

DROP PROCEDURE GetData

-- Example -2




-- Example -3

CREATE OR ALTER PROCEDURE GetData @wid int

AS BEGIN
  declare @brid int = 9;

with cte1 as (
  select t1.product_id as pid,t1.branch_id as brid, sum(t1.quantity) as qty, sum(t1.total) as total, (sum(t1.total)/sum(t1.quantity)) as price
  from purchasedetails as t1 where t1.branch_id = @brid
  group by t1.product_id, t1.branch_id
)

--select * from cte1;
update products set paprice = t2.price, caprice = t2.price
from products as t1 join (select * from cte1) as t2 on t1.id = t2.pid where t1.branch_id = @brid
--update proavamounts set price = t2.price
--from proavamounts as t1 join (select * from cte1) as t2 on t1.product_id = t2.pid;

-- inserting multiple row example - 1
insert into proavamounts (product_id,branch_id,price) 
select t1.id as product_id, t1.branch_id as branch_id, t1.caprice
from products as t1

-- inserting multiple row example - 1
insert into vreturndetails (sale_id,saledetail_id) 
select t1.id as sale_id, t2.id as saledetails_id
from sales as t1 join saledetails as t2 on t2.sale_id = t1.id where t1.id = 17


END

Exec GetData @brid = 9;

DROP PROCEDURE GetData

-- Example -3




-- Example -4

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

-- Example -4