<?php
#
# stock query with warehouse with opening balance
# 
# 



CREATE OR ALTER PROCEDURE [dbo].[BLS_DWOCB_WWH] @wid int, @pfdate datetime, @ptdate datetime, @fdate datetime, @tdate datetime
AS BEGIN



--declare @whid int = 9;
--declare @pfdatev datetime = '2021-01-01';
--declare @ptdatev datetime = '2021-01-31';

--declare @fdatev datetime = '2021-01-01';
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
cte00 as( 
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

cte1 as (
select sum(t1.clbcredit) as tcredit  from 
accjaopenbalances as t1 where t1.accstatus = 3 and t1.relation = 1 and type !=2 and t1.warehouse_id = @whid

), 

cte2 as (
select sum(t1.clbcredit) as tcredit  from 
accjaopenbalances as t1 where t1.accstatus = 3 and t1.relation = 0 and type !=2 and t1.warehouse_id = @whid

), 

cte3 as (
select sum(t1.clbdebit) as tdebit
from accjaopenbalances as t1
where t1.accstatus = 4 and t1.relation = 1 and type !=2 and t1.warehouse_id = @whid
), 

cte4 as (
select sum(t1.clbdebit) as tdebit
from accjaopenbalances as t1
where t1.accstatus = 4  and t1.relation = 0 and type !=2 and t1.warehouse_id = @whid
),

cte5 as (
select sum(t1.clbcredit) as tcredit 
from accjaopenbalances as t1
where t1.accstatus = 3 and t1.type = 2 and t1.warehouse_id = @whid
),

cte6 as (
select sum(t1.clbdebit) as tdebit 
from accjaopenbalances as t1
where t1.accstatus = 4 and t1.type = 2 and t1.warehouse_id = @whid
),

cteta as (
select sum(t1.clbdebit) as tasset
from accjaopenbalances as t1
where t1.accstatus = 1  and t1.warehouse_id = @whid
),

ctetl as (
select sum(t1.clbcredit) as tliabilities
from accjaopenbalances as t1
where t1.accstatus = 2  and t1.warehouse_id = @whid
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
(select (case when t6.tdebit is null then 0 else t6.tdebit end) from cte6 as t6) as indexpense,
(select (case when t7.tasset is null then 0 else t7.tasset end) from cteta as t7) as asset,
(select (case when t8.tliabilities is null then 0 else t8.tliabilities end) from ctetl as t8) as liabilities
from cte1 as t1
),

 cte8 as(
select 

openingstock, purchase, dexpense, 

closingstock, sale, dincome,

((openingstock + purchase + dexpense) - (closingstock + sale + dincome)) as grosslossco,

((openingstock + purchase + dexpense) - (closingstock + sale + dincome)) as grosslossbf,
indexpense,indincome,asset,liabilities
from cte7

),
cte9 as (
select 
openingstock, purchase, dexpense, closingstock, sale, dincome,grosslossco,grosslossbf,indexpense,indincome,

((indincome - (grosslossbf)) - (indexpense)) as netprofit,asset,liabilities


from cte8
)

select openingstock, purchase, dexpense, closingstock, sale, dincome,grosslossco,grosslossbf,
indexpense,indincome,netprofit,

((grosslossbf) + (indexpense) + (netprofit) ) as totlaexpense,

indincome as totalincome,asset,liabilities

from cte9;


END

--Exec BLS_DWOCB_WWH @wid = 9, @pfdate = '2021-01-01', @ptdate = '2021-04-01', @fdate = '2021-04-02', @tdate = '2021-04-15';

--DROP PROCEDURE BLS_DWOCB_WWH



#
# stock query with warehouse with opening balance
# 
# 