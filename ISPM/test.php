<?php

# stock query with warehouse
# 

declare @whid int = 9;
select  (
    (case when sum(t2.quantity) is null then 0 else sum(t2.quantity) end) - 
    (select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t3.warehouse_id = @whid )
    ) as stock
    from products as t1 
    left join purchasedetails as t2 on t1.id = t2.product_id where t2.warehouse_id = @whid;

# 
# stock query with warehouse