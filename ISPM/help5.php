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
with cte1 as (
select t1.id as product_id, (
	(case when sum(t2.quantity) is null then 0 else sum(t2.quantity) end) - 
	(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid )
	) as stock, 

	(
	--kk
	(
	(case when sum(t2.quantity) is null then 0 else sum(t2.quantity) end) - 
	(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.branch_id = @brid )
	) * (select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.branch_id = @brid)
	--kk
	) as stkam

	from products as t1 
	left join purchasedetails as t2 on t1.id = t2.product_id
	where t2.branch_id = @brid
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
with cte1 as (
select t1.id as product_id, (
  (case when sum(t2.quantity) is null then 0 else sum(t2.quantity) end) - 
  (select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid )
  ) as stock, 

  (
  --kk
  (
  (case when sum(t2.quantity) is null then 0 else sum(t2.quantity) end) - 
  (select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid )
  ) * (select (case when avg(t3.price) is null then 0 else avg(t3.price) end) from proavamounts as t3 where t3.product_id = t1.id and t3.warehouse_id = @whid)
  --kk
  ) as stkam

  from products as t1 
  left join purchasedetails as t2 on t1.id = t2.product_id
  where t2.warehouse_id = @whid
  group by t1.id
)

select sum(stkam) as tstock from cte1;

# total stock query with warehouse
# 