<?php
#
# stock query with warehouse with opening balance
# 
# 


CREATE OR ALTER  PROCEDURE [dbo].[WRPCHK_WBRPRSN] @bid int, @pid int, @sno nvarchar
AS BEGIN
-- start code
declare @brid int = @bid;
declare @proid int = @pid;
declare @snum nvarchar = @sno;
select t1.id as pid, t1.name_en as pname, t1.productcode as pcode, 
t2.sno as sno, t2.wrperiod as wrperiod, CONVERT(varchar(10), t2.vchdate, 120) as vchdate,
cast( getdate() as date ) as cdate, dateadd(DD, t2.wrperiod, cast(t2.vchdate as date)) as wwrpdate,
datediff(day,(cast( getdate() as date )),(dateadd(DD, t2.wrperiod, cast(t2.vchdate as date)))) as wrpleft
from products as t1 
inner join saledetails as t2 on t2.product_id = t1.id 
where t1.branch_id = @brid and t1.isitem = 1 and t1.id = @proid and t2.sno = @snum
-- end code
END

--Exec WRPCHK_WBRPRSN @bid = 9;

--DROP PROCEDURE WRPCHK_WBRPRSN

-- with branch product serial no
-- Example - WRPCHK_WBRPRSN