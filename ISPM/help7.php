<?php
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