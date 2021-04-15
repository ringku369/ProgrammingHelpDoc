<?php



#
# stock query with branch with opening balance
# 
# 


-- STK_DWOCB_WBR - 1

CREATE OR ALTER PROCEDURE STK_DWOCB_WBR @bid int, @pfdate datetime, @ptdate datetime, @fdate datetime, @tdate datetime
AS BEGIN

--declare @brid int = 9;
--declare @pfdatev datetime = '2021-03-03';
--declare @ptdatev datetime = '2021-04-01';

--declare @fdatev datetime = '2021-04-02';
--declare @tdatev datetime = '2021-04-18';

declare @brid int = @bid;
declare @pfdatev datetime = @pfdate
declare @ptdatev datetime = @ptdate;

declare @fdatev datetime = @fdate;
declare @tdatev datetime = @tdate;



with cte0 as( 
select t1.id as id, t1.name_en, t1.productcode as code, t2.name_en as unittype, t2.code as unitcode, 
(select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.branch_id = @brid) as avgprice,
(
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @ptdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @ptdatev )
) as stockqty,


((
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @ptdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @ptdatev )
) * (select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.branch_id = @brid)) as stockamount

from products as t1  join productunittypes as t2 on t2.id = t1.productunittype_id
),

cte1 as( 
select t1.id as id, t1.name_en, t1.productcode as code, t2.name_en as unittype, t2.code as unitcode, 
(select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.branch_id = @brid) as avgprice,
(
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev )
) as stockqty,


((
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev )
) * (select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.branch_id = @brid)) as stockamount

from products as t1  join productunittypes as t2 on t2.id = t1.productunittype_id
),

cte2 as( 
select t1.id as id, t1.name_en, t1.productcode as code, t2.name_en as unittype, t2.code as unitcode, 
(select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.branch_id = @brid) as avgprice,
(
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev )
) as stockqty,


((
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev )
) * (select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.branch_id = @brid)) as stockamount

from products as t1  join productunittypes as t2 on t2.id = t1.productunittype_id
),

cte3 as( 
select t1.id as id, t1.name_en, t1.productcode as code, t2.name_en as unittype, t2.code as unitcode, 
(select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.branch_id = @brid) as avgprice,
(
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @tdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @tdatev )
) as stockqty,


((
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @tdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @tdatev )
) * (select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.branch_id = @brid)) as stockamount

from products as t1  join productunittypes as t2 on t2.id = t1.productunittype_id
)

select 'Opening Stock' as name, sum(stockqty) as quantity, sum(stockamount) as stock from cte0
union all
--select * from cte1
--union all
select  'Closing Stock' as name, sum(stockqty) as quantity, sum(stockamount) as stock from cte2
--union all
--select null as id, null as name_en, null as productcode, null as unittype, null as unitcode,null as avgprice, sum(stockqty) as qty, sum(stockamount) as stockamount from cte3;

END

--Exec STK_DWOCB_WBR @bid = 9, @pfdate = '2021-01-01', @ptdate = '2021-04-01', @fdate = '2021-04-02', @tdate = '2021-04-15';

--DROP PROCEDURE STK_DWOCB_WBR


-- STK_DWOCB_WBR - 1

#
# stock query with branch with opening balance
# 
# 


#
# stock query with warehouse with opening balance
# 
# 


-- STK_DWOCB_WWH - 1

CREATE OR ALTER PROCEDURE STK_DWOCB_WWH @wid int, @pfdate datetime, @ptdate datetime, @fdate datetime, @tdate datetime
AS BEGIN

--declare @whid int = 9;
--declare @pfdatev datetime = '2021-03-03';
--declare @ptdatev datetime = '2021-04-01';

--declare @fdatev datetime = '2021-04-02';
--declare @tdatev datetime = '2021-04-18';

declare @whid int = @wid;
declare @pfdatev datetime = @pfdate
declare @ptdatev datetime = @ptdate;

declare @fdatev datetime = @fdate;
declare @tdatev datetime = @tdate;



with cte0 as( 
select t1.id as id, t1.name_en, t1.productcode as code, t2.name_en as unittype, t2.code as unitcode, 
(select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.warehouse_id = @whid) as avgprice,
(
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @ptdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @ptdatev )
) as stockqty,


((
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @ptdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @ptdatev )
) * (select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.warehouse_id = @whid)) as stockamount

from products as t1  join productunittypes as t2 on t2.id = t1.productunittype_id
),

cte1 as( 
select t1.id as id, t1.name_en, t1.productcode as code, t2.name_en as unittype, t2.code as unitcode, 
(select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.warehouse_id = @whid) as avgprice,
(
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev )
) as stockqty,


((
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev )
) * (select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.warehouse_id = @whid)) as stockamount

from products as t1  join productunittypes as t2 on t2.id = t1.productunittype_id
),

cte2 as( 
select t1.id as id, t1.name_en, t1.productcode as code, t2.name_en as unittype, t2.code as unitcode, 
(select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.warehouse_id = @whid) as avgprice,
(
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev )
) as stockqty,


((
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev )
) * (select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.warehouse_id = @whid)) as stockamount

from products as t1  join productunittypes as t2 on t2.id = t1.productunittype_id
),

cte3 as( 
select t1.id as id, t1.name_en, t1.productcode as code, t2.name_en as unittype, t2.code as unitcode, 
(select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.warehouse_id = @whid) as avgprice,
(
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @tdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @tdatev )
) as stockqty,


((
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @tdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @tdatev )
) * (select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.warehouse_id = @whid)) as stockamount

from products as t1  join productunittypes as t2 on t2.id = t1.productunittype_id
)

select 'Opening Stock' as name, sum(stockqty) as quantity, sum(stockamount) as stock from cte0
union all
--select * from cte1
--union all
select  'Closing Stock' as name, sum(stockqty) as quantity, sum(stockamount) as stock from cte2
--union all
--select null as id, null as name_en, null as productcode, null as unittype, null as unitcode,null as avgprice, sum(stockqty) as qty, sum(stockamount) as stockamount from cte3;

END

--Exec STK_DWOCB_WWH @wid = 9, @pfdate = '2021-01-01', @ptdate = '2021-04-01', @fdate = '2021-04-02', @tdate = '2021-04-15';

--DROP PROCEDURE STK_DWOCB_WWH


-- STK_DWOCB_WWH - 1

#
# stock query with warehouse with opening balance
# 
# 




# 
### Opening Or Closing Stock
#

Exec STK_DWOCB_WBR @bid = 9, @pfdate = '2021-01-01', @ptdate = '2021-01-31', @fdate = '2021-02-01', 
@tdate = '2021-04-20';



# 
### Relational Purchase Or Sale Accounts
#

--Income
select sum(t1.debit) as tdebit, sum(t1.credit) as tcredit 
from accjourpostdetails as t1 left join accjournalaccounts as t2 on t2.id = t1.accjournalaccount_id
where t2.accstatus = 3 and t2.relation = 1;

--Expense
select sum(t1.debit) as tdebit, sum(t1.credit) as tcredit 
from accjourpostdetails as t1 left join accjournalaccounts as t2 on t2.id = t1.accjournalaccount_id
where t2.accstatus = 4  and t2.relation = 1;



# 
### Direct Income Or Expense
#

--Income
select sum(t1.debit) as tdebit, sum(t1.credit) as tcredit 
from accjourpostdetails as t1 left join accjournalaccounts as t2 on t2.id = t1.accjournalaccount_id
where t2.accstatus = 3  and t2.relation = 0;

with cte as (
select t1.accjournalaccount_id as jid, sum(t1.debit) as tdebit, sum(t1.credit) as tcredit 
from accjourpostdetails as t1 left join accjournalaccounts as t2 on t2.id = t1.accjournalaccount_id
where t2.accstatus = 3  and t2.relation = 0 group by t1.accjournalaccount_id
)

select t1.name as ledger, t2.tdebit, t2.tcredit from accjournalaccounts as t1 join ( select * from cte) as t2 on t2.jid = t1.id



--Expense

select sum(t1.debit) as tdebit, sum(t1.credit) as tcredit 
from accjourpostdetails as t1 left join accjournalaccounts as t2 on t2.id = t1.accjournalaccount_id
where t2.accstatus = 4  and t2.relation = 0;

with cte as (
select t1.accjournalaccount_id as jid, sum(t1.debit) as tdebit, sum(t1.credit) as tcredit 
from accjourpostdetails as t1 left join accjournalaccounts as t2 on t2.id = t1.accjournalaccount_id
where t2.accstatus = 4  and t2.relation = 0 group by t1.accjournalaccount_id
)

select t1.name as ledger, t2.tdebit, t2.tcredit from accjournalaccounts as t1 join ( select * from cte) as t2 on t2.jid = t1.id



--Total Income & Expense

declare @brid int = 9;
declare @pfdatev datetime = '2021-01-01';
declare @ptdatev datetime = '2021-01-31';

declare @fdatev datetime = '2021-02-01';
declare @tdatev datetime = '2021-04-18';

--declare @brid int = @bid;
--declare @pfdatev datetime = @pfdate
--declare @ptdatev datetime = @ptdate;

--declare @fdatev datetime = @fdate;
--declare @tdatev datetime = @tdate;



with cte0 as( 
select t1.id as id, t1.name_en, t1.productcode as code, t2.name_en as unittype, t2.code as unitcode, 
(select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.branch_id = @brid) as avgprice,
(
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @ptdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @ptdatev )
) as stockqty,


((
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @ptdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @ptdatev )
) * (select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.branch_id = @brid)) as stockamount

from products as t1  join productunittypes as t2 on t2.id = t1.productunittype_id
),
cte00 as( 
select t1.id as id, t1.name_en, t1.productcode as code, t2.name_en as unittype, t2.code as unitcode, 
(select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.branch_id = @brid) as avgprice,
(
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev )
) as stockqty,


((
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev )
) * (select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.branch_id = @brid)) as stockamount

from products as t1  join productunittypes as t2 on t2.id = t1.productunittype_id
),

cte1 as (
select sum(t1.credit) as tcredit 
from accjourpostdetails as t1 left join accjournalaccounts as t2 on t2.id = t1.accjournalaccount_id
where t2.accstatus = 3 and t2.relation = 1
and t1.branch_id = @brid and t1.status = 1 and convert(varchar(10),t1.vchdate, 121)  between  @fdatev and @tdatev
), 

cte2 as (
select sum(t1.credit) as tcredit 
from accjourpostdetails as t1 left join accjournalaccounts as t2 on t2.id = t1.accjournalaccount_id
where t2.accstatus = 3  and t2.relation = 0
and t1.branch_id = @brid and t1.status = 1 and convert(varchar(10),t1.vchdate, 121)  between  @fdatev and @tdatev
), 

cte3 as (
select sum(t1.debit) as tdebit
from accjourpostdetails as t1 left join accjournalaccounts as t2 on t2.id = t1.accjournalaccount_id
where t2.accstatus = 4 and t2.relation = 1
and t1.branch_id = @brid and t1.status = 1  and convert(varchar(10),t1.vchdate, 121)  between  @fdatev and @tdatev
), 

cte4 as (
select sum(t1.debit) as tdebit
from accjourpostdetails as t1 left join accjournalaccounts as t2 on t2.id = t1.accjournalaccount_id
where t2.accstatus = 4  and t2.relation = 0
and t1.status = 1 and t1.branch_id = @brid and convert(varchar(10),t1.vchdate, 121)  between  @fdatev and @tdatev
),

cte5 as (
select sum(t1.credit) as tcredit 
from accjourpostdetails as t1 left join accjournalaccounts as t2 on t2.id = t1.accjournalaccount_id
where t2.accstatus = 3 and t2.type = 2
and t1.status = 1 and t1.branch_id = @brid and convert(varchar(10),t1.vchdate, 121)  between  @fdatev and @tdatev
),

cte6 as (
select sum(t1.debit) as tdebit 
from accjourpostdetails as t1 left join accjournalaccounts as t2 on t2.id = t1.accjournalaccount_id
where t2.accstatus = 4 and t2.type = 2
and t1.status = 1 and t1.branch_id = @brid and convert(varchar(10),t1.vchdate, 121)  between  @fdatev and @tdatev
),

cte7 as (
select 
(select (case when sum(t0.stockamount) is null then 0 else sum(t0.stockamount) end) from cte0 as t0) as openingstock,
(select (case when sum(t00.stockamount) is null then 0 else sum(t00.stockamount) end) from cte00 as t00) as closingstock,

(case when t1.tcredit is null then 0 else t1.tcredit end) as sale, 
(select (case when t2.tcredit is null then 0 else t2.tcredit end) from cte2 as t2) as dincome, 
(select (case when t3.tdebit is null then 0 else t3.tdebit end) from cte3 as t3) as purchase, 
(select (case when t4.tdebit is null then 0 else t4.tdebit end) from cte4 as t4) as dexpense,

(select (case when t5.tcredit is null then 0 else t5.tcredit end) from cte5 as t5) as indincome,
(select (case when t6.tdebit is null then 0 else t6.tdebit end) from cte6 as t6) as indexpense
from cte1 as t1
),

 cte8 as(
select 

openingstock, purchase, dexpense, 

closingstock, sale, dincome,

((openingstock + purchase + dexpense) - (closingstock + sale + dincome)) as grosslossco,

((openingstock + purchase + dexpense) - (closingstock + sale + dincome)) as grosslossbf,
indexpense,indincome
from cte7

),
cte9 as (
select 
openingstock, purchase, dexpense, closingstock, sale, dincome,grosslossco,grosslossbf,indexpense,indincome,

((indincome - (grosslossbf)) - (indexpense)) as netprofit


from cte8
)

select openingstock, purchase, dexpense, closingstock, sale, dincome,grosslossco,grosslossbf,
indexpense,indincome,netprofit,

((grosslossbf) + (indexpense) + (netprofit) ) as totlaexpense,

indincome as totalincome

from cte9;

