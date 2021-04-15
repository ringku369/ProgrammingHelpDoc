<?php

-- #stock query
select * from branches;
select * from products;
select * from proavamounts;
select * from purchasedetails;
select * from saledetails;



select t1.id as product_id, (
((case when sum(t2.quantity) is null then 0 else sum(t2.quantity) end)) - 
(
	select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id
)
) as stock, (select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id) as sale
from products as t1 
left join purchasedetails as t2 on t1.id = t2.product_id 
group by t1.id


# stock query with branch
# 

declare @brid int = 9;
with cte1 as (
	select t1.id as product_id, (
	(case when sum(t2.quantity) is null then 0 else sum(t2.quantity) end) - 
	(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid )
	) as stock
	from products as t1 
	left join purchasedetails as t2 on t1.id = t2.product_id where t2.branch_id = @brid
	group by t1.id
)
--select * from cte1;
select t1.id as id, t1.name_en, t1.productcode as code, t4.name_en as unittype, t4.code as unitcode, (case when t2.stock is null then 0 else t2.stock end) as stockqty, 
(select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.branch_id = @brid) as avgprice,

((case when t2.stock is null then 0 else t2.stock end) * (select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.branch_id = @brid) ) as stockamount


from products as t1 left join (
	select * from cte1
) as t2 on t2.product_id = t1.id join productunittypes as t4 on t4.id = t1.productunittype_id;

# 
# stock query with branch
# 
# 

# stock query with branch
# 

declare @brid int = 9;
declare @fdatev datetime = '2021-03-03';
declare @tdatev datetime = '2021-04-12';

with cte1 as (
	select t1.id as product_id, (
	(case when sum(t2.quantity) is null then 0 else sum(t2.quantity) end) - 
	(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev )
	) as stock
	from products as t1 
	left join purchasedetails as t2 on t1.id = t2.product_id where t2.branch_id = @brid and convert(varchar(10),t2.vchdate, 121)  between  @fdatev and @tdatev
	group by t1.id
)
--select * from cte1;
select t1.id as id, t1.name_en, t1.productcode as code, t4.name_en as unittype, t4.code as unitcode, (case when t2.stock is null then 0 else t2.stock end) as stockqty, 
(select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.branch_id = @brid) as avgprice,

((case when t2.stock is null then 0 else t2.stock end) * (select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.branch_id = @brid) ) as stockamount


from products as t1 left join (
	select * from cte1
) as t2 on t2.product_id = t1.id join productunittypes as t4 on t4.id = t1.productunittype_id;



# 
# stock query with branch
# 
# 

# stock query with warehouse
# 

declare @whid int = 4;
declare @fdatev datetime = '2021-03-03';
declare @tdatev datetime = '2021-04-12';
with cte1 as (
    select t1.id as product_id, (
    (case when sum(t2.quantity) is null then 0 else sum(t2.quantity) end) - 
    (select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev )
    ) as stock
    from products as t1 
    left join purchasedetails as t2 on t1.id = t2.product_id where t2.warehouse_id = @whid and convert(varchar(10),t2.vchdate, 121)  between  @fdatev and @tdatev
    group by t1.id
)
--select * from cte1;
select t1.id as id, t1.name_en, t1.productcode as code, t4.name_en as unittype, t4.code as unitcode, (case when t2.stock is null then 0 else t2.stock end) as stockqty, 
(select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.warehouse_id = @whid) as avgprice,

((case when t2.stock is null then 0 else t2.stock end) * (select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.warehouse_id = @whid) ) as stockamount


from products as t1 left join (
    select * from cte1
) as t2 on t2.product_id = t1.id join productunittypes as t4 on t4.id = t1.productunittype_id;

# 
# stock query with warehouse
# 
# 
# stock query with warehouse
# 

declare @whid int = 4;
with cte1 as (
    select t1.id as product_id, (
    (case when sum(t2.quantity) is null then 0 else sum(t2.quantity) end) - 
    (select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid )
    ) as stock
    from products as t1 
    left join purchasedetails as t2 on t1.id = t2.product_id where t2.warehouse_id = @whid
    group by t1.id
)
--select * from cte1;
select t1.id as id, t1.name_en, t1.productcode as code, t4.name_en as unittype, t4.code as unitcode, (case when t2.stock is null then 0 else t2.stock end) as stockqty, 
(select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.warehouse_id = @whid) as avgprice,

((case when t2.stock is null then 0 else t2.stock end) * (select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.warehouse_id = @whid) ) as stockamount


from products as t1 left join (
    select * from cte1
) as t2 on t2.product_id = t1.id join productunittypes as t4 on t4.id = t1.productunittype_id;

# 
# stock query with warehouse
# 
# 

# total stock query with branch
# 
declare @brid int = 9;
select  (
	(case when sum(t2.quantity) is null then 0 else sum(t2.quantity) end) - 
	(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t3.branch_id = @brid )
	) as stock
	from products as t1 
	left join purchasedetails as t2 on t1.id = t2.product_id where t2.branch_id = @brid;

# total stock query with branch
# 
# total stock query with branch
# 

declare @brid int = 9;
declare @fdatev datetime = '2021-03-03';
declare @tdatev datetime = '2021-04-12';
with cte1 as (
select t1.id as product_id, (
	(case when sum(t2.quantity) is null then 0 else sum(t2.quantity) end) - 
	(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev)
	) as stock, 

	(
	--kk
	(
	(case when sum(t2.quantity) is null then 0 else sum(t2.quantity) end) - 
	(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev)
	) * (select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.branch_id = @brid)
	--kk
	) as stkam

	from products as t1 
	left join purchasedetails as t2 on t1.id = t2.product_id
	where t2.branch_id = @brid and convert(varchar(10),t2.vchdate, 121)  between  @fdatev and @tdatev
	group by t1.id
)

select sum(stkam) as tstock from cte1;

# total stock query with branch
# 
# 
# total stock query with warehouse
# 
declare @whid int = 4;
select  (
    (case when sum(t2.quantity) is null then 0 else sum(t2.quantity) end) - 
    (select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t3.warehouse_id = @whid )
    ) as stock
    from products as t1 
    left join purchasedetails as t2 on t1.id = t2.product_id where t2.warehouse_id = @whid;

# total stock query with warehouse
# 
# 
# total stock query with warehouse
# 
declare @whid int = 2;
declare @fdatev datetime = '2021-03-03';
declare @tdatev datetime = '2021-04-12';
with cte1 as (
select t1.id as product_id, (
  (case when sum(t2.quantity) is null then 0 else sum(t2.quantity) end) - 
  (select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev)
  ) as stock, 

  (
  --kk
  (
  (case when sum(t2.quantity) is null then 0 else sum(t2.quantity) end) - 
  (select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev)
  ) * (select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.warehouse_id = @whid)
  --kk
  ) as stkam

  from products as t1 
  left join purchasedetails as t2 on t1.id = t2.product_id
  where t2.warehouse_id = @whid and convert(varchar(10),t2.vchdate, 121)  between  @fdatev and @tdatev
  group by t1.id
)

select sum(stkam) as tstock from cte1;

# total stock query with warehouse
# 



#
# stock query with branch
# 

-- STK_DW_WBR -2

CREATE OR ALTER PROCEDURE STK_DW_WBR @bid int, @fdate datetime ,@tdate datetime
AS BEGIN


declare @brid int = @bid;

declare @fdatev datetime = @fdate;
declare @tdatev datetime = @tdate;

--declare @fdatev datetime = '2021-04-13';
--declare @tdatev datetime = '2021-04-13';

with cte1 as (
select t1.id as product_id, (
  (case when sum(t2.quantity) is null then 0 else sum(t2.quantity) end) - 
  (select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev)
  ) as stock, 

  (
  --kk
  (
  (case when sum(t2.quantity) is null then 0 else sum(t2.quantity) end) - 
  (select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev)
  ) * (select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.branch_id = @brid)
  --kk
  ) as stkam

  from products as t1 
  left join purchasedetails as t2 on t1.id = t2.product_id
  where t2.branch_id = @brid and convert(varchar(10),t2.vchdate, 121)  between  @fdatev and @tdatev
  group by t1.id
)

select sum(stkam) as tstock from cte1;


END

--Exec STK_DW_WBR @bid = 9, @fdate = '2021-01-01', @tdate = '2021-04-15';

--DROP PROCEDURE STK_DW_WBR

-- STK_DW_WBR -2

#
# stock query with branch
# 




#
# stock query with warehouse
# 

-- STK_DW_WWH -2

CREATE OR ALTER PROCEDURE STK_DW_WWH @wid int, @fdate datetime ,@tdate datetime
AS BEGIN

declare @whid int = @wid;

declare @fdatev datetime = @fdate;
declare @tdatev datetime = @tdate;

--declare @fdatev datetime = '2021-04-13';
--declare @tdatev datetime = '2021-04-13';


with cte1 as (
select t1.id as product_id, (
  (case when sum(t2.quantity) is null then 0 else sum(t2.quantity) end) - 
  (select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev)
  ) as stock, 

  (
  --kk
  (
  (case when sum(t2.quantity) is null then 0 else sum(t2.quantity) end) - 
  (select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev)
  ) * (select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.warehouse_id = @whid)
  --kk
  ) as stkam

  from products as t1 
  left join purchasedetails as t2 on t1.id = t2.product_id
  where t2.warehouse_id = @whid and convert(varchar(10),t2.vchdate, 121)  between  @fdatev and @tdatev
  group by t1.id
)

select sum(stkam) as tstock from cte1;


END

--Exec STK_DW_WWH @bid = 2, @fdate = '2021-01-01', @tdate = '2021-04-15';

--DROP PROCEDURE STK_DW_WWH

-- STK_DW_WWH -2


#
# stock query with warehouse
# 
# 

#
# stock query with branch with opening balance
# 
# 


-- STK_DWOB_WBR - 1

CREATE OR ALTER PROCEDURE STK_DWOB_WBR @bid int, @pfdate datetime, @ptdate datetime, @fdate datetime, @tdate datetime
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

select null as id, null as name_en, null as productcode, null as unittype, null as unitcode,null as avgprice, sum(stockqty) as qty, sum(stockamount) as stockamount from cte0
union all
select * from cte1
union all
select null as id, null as name_en, null as productcode, null as unittype, null as unitcode,null as avgprice, sum(stockqty) as qty, sum(stockamount) as stockamount from cte2
union all
select null as id, null as name_en, null as productcode, null as unittype, null as unitcode,null as avgprice, sum(stockqty) as qty, sum(stockamount) as stockamount from cte3;


END

--Exec STK_DWOB_WBR @bid = 9, @pfdate = '2021-01-01', @ptdate = '2021-04-01', @fdate = '2021-04-02', @tdate = '2021-04-15';

--DROP PROCEDURE STK_DWOB_WBR


-- STK_DWOB_WBR - 1

#
# stock query with branch with opening balance
# 
# 

#
# stock query with branch with opening balance
# 
# 


-- STK_DWOB_WWH - 1

CREATE OR ALTER PROCEDURE STK_DWOB_WWH @wid int, @pfdate datetime, @ptdate datetime, @fdate datetime, @tdate datetime
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

select null as id, null as name_en, null as productcode, null as unittype, null as unitcode,null as avgprice, sum(stockqty) as qty, sum(stockamount) as stockamount from cte0
union all
select * from cte1
union all
select null as id, null as name_en, null as productcode, null as unittype, null as unitcode,null as avgprice, sum(stockqty) as qty, sum(stockamount) as stockamount from cte2
union all
select null as id, null as name_en, null as productcode, null as unittype, null as unitcode,null as avgprice, sum(stockqty) as qty, sum(stockamount) as stockamount from cte3;


END

--Exec STK_DWOB_WWH @wid = 9, @pfdate = '2021-01-01', @ptdate = '2021-04-01', @fdate = '2021-04-02', @tdate = '2021-04-15';

--DROP PROCEDURE STK_DWOB_WWH


-- STK_DWOB_WWH - 1

#
# stock query with branch with opening balance
# 
# 
