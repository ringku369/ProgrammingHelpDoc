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




-- Example -5

CREATE OR ALTER PROCEDURE [dbo].[PAPRCU_WBR] @bid int, @fdate datetime, @tdate datetime
AS BEGIN
-- start code
declare @brid int = @bid;
declare @fdatev datetime = @fdate;
declare @tdatev datetime = @tdate;


with cte1 as (
  select t1.product_id as pid,(sum(t1.total)/sum(t1.quantity)) as price
  from purchasedetails as t1 where t1.branch_id = @brid and convert(varchar(10),t1.vchdate, 121)  between  @fdatev and @tdatev
  group by t1.product_id, t1.branch_id
)

--select * from cte1;
update products set caprice = t2.price
from products as t1 join (select * from cte1) as t2 on t1.id = t2.pid where t1.branch_id = @brid

--Exec PAPRCU_WBR @bid = 9, @fdate = '2021-04-03', @tdate = '2021-04-03';
-- Current Avg Price Update with Branch
-- end code
END

-- Example -5

-- Example -6

CREATE OR ALTER PROCEDURE [dbo].[PAPRCU_WBR] @bid int, @pfdate datetime, @ptdate datetime
AS BEGIN
-- start code
declare @brid int = @bid;
declare @pfdatev datetime = @pfdate
declare @ptdatev datetime = @ptdate;


with cte1 as (
  select t1.product_id as pid,(sum(t1.total)/sum(t1.quantity)) as price
  from purchasedetails as t1 where t1.branch_id = @brid and convert(varchar(10),t1.vchdate, 121)  between  @pfdatev and @ptdatev
  group by t1.product_id, t1.branch_id
)

--select * from cte1;
update products set paprice = t2.price
from products as t1 join (select * from cte1) as t2 on t1.id = t2.pid where t1.branch_id = @brid

--Exec PAPRCU_WBR @bid = 9, @pfdate = '2021-04-03', @ptdate = '2021-04-03';
-- Previous Avg Price Update with Branch
-- end code
END

-- Example -6

proavamounts
t1.paprice
t1.caprice



(select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.branch_id = @brid) as avgprice,



CREATE OR ALTER PROCEDURE [dbo].[AVPR_1] @bid int, @fdate datetime, @tdate datetime
AS BEGIN
-- start code
declare @brid int = @bid;
declare @fdatev datetime = @fdate;
declare @tdatev datetime = @tdate;


with cte1 as (
  select t1.product_id as pid,(sum(t1.total)/sum(t1.quantity)) as price
  from purchasedetails as t1 where t1.branch_id = @brid and convert(varchar(10),t1.vchdate, 121)  between  @fdatev and @tdatev
  group by t1.product_id, t1.branch_id
)

--select * from cte1;
update products set caprice = t2.price
from products as t1 join (select * from cte1) as t2 on t1.id = t2.pid where t1.branch_id = @brid

--Exec AVPR_1 @bid = 9, @fdate = '2021-04-03', @tdate = '2021-04-03';
-- Current Avg Price Update with Branch
-- end code
END





CREATE OR ALTER PROCEDURE [dbo].[AVPR_2] @bid int, @pfdate datetime, @ptdate datetime
AS BEGIN
-- start code
declare @brid int = @bid;
declare @pfdatev datetime = @pfdate
declare @ptdatev datetime = @ptdate;


with cte1 as (
  select t1.product_id as pid,(sum(t1.total)/sum(t1.quantity)) as price
  from purchasedetails as t1 where t1.branch_id = @brid and convert(varchar(10),t1.vchdate, 121)  between  @pfdatev and @ptdatev
  group by t1.product_id, t1.branch_id
)

--select * from cte1;
update products set paprice = t2.price
from products as t1 join (select * from cte1) as t2 on t1.id = t2.pid where t1.branch_id = @brid

--Exec AVPR_2 @bid = 9, @pfdate = '2021-04-03', @ptdate = '2021-04-03';
-- Previous Avg Price Update with Branch
-- end code
END





CREATE OR ALTER PROCEDURE [dbo].[AVPR_3] @bid int, @pfdate datetime, @tdate datetime
AS BEGIN
-- start code
declare @brid int = @bid;
declare @pfdatev datetime = @pfdate
declare @tdatev datetime = @tdate;


with cte1 as (
  select t1.product_id as pid,(sum(t1.total)/sum(t1.quantity)) as price
  from purchasedetails as t1 where t1.branch_id = @brid and convert(varchar(10),t1.vchdate, 121)  between  @pfdatev and @tdatev
  group by t1.product_id, t1.branch_id
)

--select * from cte1;
update products set pcaprice = t2.price
from products as t1 join (select * from cte1) as t2 on t1.id = t2.pid where t1.branch_id = @brid

--Exec AVPR_3 @bid = 9, @pfdate = '2021-04-03', @tdate = '2021-04-03';
-- Previous Avg Price Update with Branch
-- end code
END

--Exec AVPR_1 @bid = 9, @fdate = '2021-04-03', @tdate = '2021-04-03';
--Exec AVPR_2 @bid = 9, @pfdate = '2021-04-03', @ptdate = '2021-04-03';
--Exec AVPR_3 @bid = 9, @pfdate = '2021-04-03', @tdate = '2021-04-03';


CREATE OR ALTER PROCEDURE [dbo].[AVPR_4] @bid int
AS BEGIN
-- start code
declare @brid int = @bid;
--declare @pfdatev datetime = @pfdate
--declare @ptdatev datetime = @ptdate;


with cte1 as (
  select t1.product_id as pid,(sum(t1.total)/sum(t1.quantity)) as price
  from purchasedetails as t1 where t1.branch_id = @brid
  group by t1.product_id, t1.branch_id
)

--select * from cte1;
update products set caprice = t2.price
from products as t1 join (select * from cte1) as t2 on t1.id = t2.pid where t1.branch_id = @brid

--Exec AVPR_4 @bid = 9;
-- Previous Avg Price Update with Branch
-- end code
END

--Exec AVPR_1 @bid = 9, @fdate = '2021-04-03', @tdate = '2021-04-03';
--Exec AVPR_2 @bid = 9, @pfdate = '2021-04-03', @ptdate = '2021-04-03';
--Exec AVPR_3 @bid = 9, @pfdate = '2021-04-03', @tdate = '2021-04-03';
--Exec AVPR_4 @bid = 9;