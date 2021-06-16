<?php

use ispm;

//isp

truncate table isppackages;

truncate table ispnetworks;
truncate table ispzones;
truncate table ispsubzones;
truncate table ispboxes;
truncate table ispclients;

truncate table ispclientinvoices;
truncate table ispclientpayments;


// accounts
truncate table accfyears;
truncate table accrelations;
truncate table acchcrmaps;

truncate table accjourposts;
truncate table accjourpostdetails;


// invetory

truncate table warehouses;
truncate table catfirsts;
truncate table catseconds;
truncate table catthirds;

truncate table itemcolors;
truncate table itemsixes;

truncate table products;

truncate table productsummaries;

truncate table purchases;
truncate table purchasedetails;

truncate table sales;
truncate table saledetails;



// common tables

truncate table users;
truncate table usermenus;
truncate table userlogs;
truncate table triggerdeleteusers;


delete from users;
delete from usermenus;
delete from userlogs;
delete from triggerdeleteusers;



select * from users;
select * from usermenus;
select * from userlogs;
select * from triggerdeleteusers;



// isp

delete from isppackages;

delete from ispnetworks;
delete from ispzones;
delete from ispsubzones;
delete from ispboxes;
delete from ispclients;

delete from ispclientinvoices;
delete from ispclientpayments;


// inventory

delete from warehouses;

delete from catfirsts;
delete from catseconds;
delete from catthirds;

delete from products;

delete from productsummaries;

delete from purchases;
delete from purchasedetails;

delete from sales;
delete from saledetails;


// accounts
delete from accfyears;
delete from accrelations;
delete from acchcrmaps;

delete from accjourposts;
delete from accjourpostdetails;



// isp

select * from ispnetworks;
select * from ispzones;
select * from ispsubzones;
select * from ispboxes;
select * from isppackages;

select * from ispclients;
select * from ispclientinvoices;
select * from ispclientpayments;

select * from users;



// inventory
select * from  warehouses;

select * from  catfirsts;
select * from  catseconds;
select * from  catthirds;

select * table itemcolors;
select * table itemsixes;
select * from  products;

select * from  productsummaries;

select * from  purchases;
select * from  purchasedetails;

select * from  sales;
select * from  saledetails;

select * from proavamounts;
select * from  userwhmaps;






// accounts

select * from accfyears;

select * from accjournalaccounts;
select * from accjaopenbalances;
select * from accjourposts;
select * from accjourpostdetails;


select * from accrelations;
select * from acchcrmaps;






// Required
delete from accjourposts;
delete from accjourpostdetails;

delete from purchases;
delete from purchasedetails;

delete from sales;
delete from saledetails;

select * from accjourposts;
select * from accjourpostdetails;

select * from  purchases;
select * from  purchasedetails;

select * from  sales;

select * from  purchasedetails;
select * from  saledetails;

select * from accjourposts;
select * from  purchases;
select * from  sales;

select * from  userwhmaps;


select * from proavamounts;
select * from vendors;
select * from customerpayments;
select * from purchases;
select * from purchasedetails;
select * from sales;
select * from saledetails;
select * from accjourposts;
select * from accjourpostdetails;



truncate table customerpayments;
truncate table purchases;
truncate table sales;
truncate table purchasedetails;
truncate table saledetails;
truncate table proavamounts;
truncate table accjourposts;
truncate table accjourpostdetails;


update sales set status = 1;
update saledetails set status = 1;


truncate table accjournalaccounts;
truncate table accjaopenbalances;
truncate table accjourposts;
truncate table accjourpostdetails;


truncate table accrelations;
truncate table acchcrmaps;


ReportCustomerLedger


accvchtype_id
JournalVchType

ReportStockF1

ReportTrailBalace

ReportProfitLoss

ReportBalanceSheet

ReportWarrantyCheck

ReportDateWiseSale

ReportDateWisePurchase



SaleToAccounts

UserWarehouseMap
AccChartofAccWHMap

ReportStockWithOpnBln

ItemColor
ItemSize

PurchaseItem
SaleItem


StockCatsWise



Exec DWP_WBR @bid = 9, @fdate = '2021-04-03', @tdate = '2021-04-30';
Exec DWP_WWH @wid = 2, @fdate = '2021-04-03', @tdate = '2021-04-30';

update ispclients set ispnetwork_id = null, ispzone_id = null , ispsubzone_id = null;
update ispboxes set ispnetwork_id = null, ispzone_id = null;
update ispsubzones set ispnetwork_id = null;


update catthirds set catfirst_id = null;
update products set catfirst_id = null, catsecond_id = null;

from ispclients as t1 
join isppackages as t2 on t2.id = t1.isppackage_id


// stock report query
select ((CASE when sum(t1.quantity) IS NULL  then 0 
else ((select distinct opening_qty from products 
where id = 6 and branch_id =  9)+ 
sum(t1.quantity)) end) - (select (case when sum(t2.quantity) IS NULL then 0 else sum(t2.quantity) end) 
from saledetails as t2 where t2.product_id = 6  AND t2.branch_id = 9)) as roqty 
from purchasedetails as t1 where t1.product_id = 6  AND t1.branch_id = 9


select t1.id as id, t1.accjournalaccount_id as accjournalaccount_id, t1.ptstatus as ptstatus, t2.name name
from acchcrmaps as t1
join accrelations as t2 on t2.id = t1.accrelation_id
where t2.name = 'Inventory Purchase' and ptstatus = 'Debit'

select t1.id as id, t1.accjournalaccount_id as accjournalaccount_id, t1.ptstatus as ptstatus, t2.name name
from acchcrmaps as t1
join accrelations as t2 on t2.id = t1.accrelation_id
where t2.name = 'Inventory Purchase' and ptstatus = 'Credit'


delete from accjourposts;
delete from accjourpostdetails;
update purchases set accstatus = 0



truncate table usermenus;
delete from usermenus;

select * from usermenus;

select * from users;

insert into usermenus (user_id,parent,child,nurl,status) values (30057,'Configaration','Configaration','#',1);

delete from usermenus where id not in(1,4,5,10,12,13);

delete from usermenus where id = 8;

select * from usermenus where user_id = 30057 AND status = 1

select * from usermenus where user_id = 30057 AND parent='Configaration' AND child<> 'Configaration'



//VS query

select top 10 * from new_job_cart where vtxno is not null;
select top 1 * from payment where job_no=5621;


select top 100 * from cash_voucher_det where tx_no=7101;
select top 1 * from cash_voucher_det where tx_no=7102;



select top 1 * from cash_voucher_det where tx_no=7102;



// for action permission code
if (this._ulevel != 100000)
{
    //==================
    string _path = HttpContext.Current.Request.Url.AbsolutePath;
    int _isEditPer = actionPermission.IsEditPermission(this._id, _path);

    if (_isEditPer == 0)
    {
        error_area.Visible = true;
        success_area.Visible = false;
        error_msg.Text = "Sorry you are not eligible for this action";
        return;
    }


}
// for action permission code

if (this._ulevel == 100000)
{
    if (DropDownList10.SelectedValue == "0")
    {
        error_area.Visible = true;
        success_area.Visible = false;
        error_msg.Text = "Please select branch before";
        return;
    }

    this._branch_id = Convert.ToInt32(DropDownList10.SelectedValue);
}


ReportStockWithOpnBln
ReportLedger

// Ledger Report

Exec LDG_WBR @bid = 9, @pfdate = '2021-01-01', @ptdate = '2021-05-31', @fdate = '2021-06-01', @tdate = '2021-07-02', @lid_id = 47;

Exec LDG_WWH @wid = 2, @pfdate = '2021-01-01', @ptdate = '2021-04-30', @fdate = '2021-05-01', @tdate = '2021-07-02', @lid_id = 47;

declare @brid int = 9;
declare @lid int = 49;

declare @pfdatev datetime = '2021-01-01';
declare @ptdatev datetime = '2021-04-30';

declare @fdatev datetime = '2021-05-01';
declare @tdatev datetime = '2021-07-30';


-- selected before date wise area-1
with cte1 as (
select sum(t1.debit) as debit, sum(t1.credit) as credit

from accjourpostdetails as t1
join accjourposts as t2 on t2.id = t1.accjourpost_id
where t2.rpmode != 0 and t1.status = 1 and t1.accjournalaccount_id = @lid and t1.branch_id = @brid
and convert(varchar(10),t1.vchdate, 121)  between  @pfdatev and @ptdatev
),

-- selected before date wise area-2
cte3 as ( 
select 
(select sum(t4.opnbdebit) from accjaopenbalances as t4 where t4.accjournalaccount_id = @lid and t4.branch_id = @brid) +

(case when sum(t1.debit) is null then 0 else sum(t1.debit) end) as debit, 

(select sum(t5.opnbcredit) from accjaopenbalances as t5 where t5.accjournalaccount_id = @lid and t5.branch_id = @brid) + 
(case when sum(t1.credit) is null then 0 else sum(t1.credit) end) as credit from cte1 as t1
),
-- opening balance
cte5 as ( 
    select 

    (case when t1.accstatus = 1 then (select (debit - credit) from cte3)
    
    when t1.accstatus = 4 then (select (debit - credit) from cte3)

    else 0 end) as debit,

    (case when t1.accstatus = 2 then (select (credit - debit) from cte3)
    
    when t1.accstatus = 3 then (select (credit - debit) from cte3)

    else 0 end) as credit
    
    from accjournalaccounts as t1 where t1.id = @lid
),


-- selected date wise area-1
cte2 as (
select  
t2.code as vno, 
convert(varchar(10),t2.vchdate,105) as vchdate, t2.narration as remarks,
t3.name as vchtype,
sum(t1.debit) as debit, sum(t1.credit) as credit

from accjourpostdetails as t1
join accjourposts as t2 on t2.id = t1.accjourpost_id
join accvchtypes as t3 on t3.id = t1.accvchtype_id
where t2.rpmode != 0 and t1.status = 1 and t1.accjournalaccount_id = @lid and t1.branch_id = @brid
and convert(varchar(10),t1.vchdate, 121)  between  @fdatev and @tdatev 

group by t1.accjourpost_id, t2.code, t2.vchdate, t2.narration, t3.name

),
-- selected date wise area-2
cte4 as (
select sum(t1.debit) as debit, sum(t1.credit) as credit
from accjourpostdetails as t1
join accjourposts as t2 on t2.id = t1.accjourpost_id
join accvchtypes as t3 on t3.id = t1.accvchtype_id
where t2.rpmode != 0 and t1.status = 1 and t1.accjournalaccount_id = @lid and t1.branch_id = @brid
and convert(varchar(10),t1.vchdate, 121)  between  @fdatev and @tdatev

),


-- selected date wise total Dr Cr
cte6 as ( 
    select ((case when debit is null then 0 else debit end) + (select debit from cte5)) as debit, 
    ((case when credit is null then 0 else credit end) + (select credit from cte5)) as credit
    from cte4
),


-- closing balance
cte8 as ( 
    select 

    (case when t1.accstatus = 1 then  (select (debit - credit) from cte6)
    
    when t1.accstatus = 4 then  (select (debit - credit) from cte6)

    else 0 end) as debit,

    (case when t1.accstatus = 2 then  (select (credit - debit) from cte6)
    
    when t1.accstatus = 3 then (select (credit - debit) from cte6)

    else 0 end) as credit
    
    from accjournalaccounts as t1 where t1.id = @lid
),

-- final result
select FORMAT (@fdatev, 'dd-MM-yyyy') as vchdate, 'Opening Balance' as remarks, null as vchtype, null as vno, debit, credit from cte5

    union all 

    select vchdate, remarks, vchtype, vno, debit, credit from cte2

    
    union all 

    select null as vchdate, null as remarks, null as vchtype, null as vno, (case when debit = 0 then 0 else debit end) as debit, (case when credit = 0 then 0 else credit end) as credit from cte6


    union all 

    select FORMAT (@tdatev, 'dd-MM-yyyy') as vchdate, 'Closing Balance' as remarks, null as vchtype, null as vno, (case when debit = 0 then 0 else debit end) as debit, (case when credit = 0 then 0 else credit end) as credit from cte8
--select * from cte3;
select * from cte10;





USE [ISPM]
GO
/****** Object:  StoredProcedure [dbo].[BLS_DWOCB_WWH]    Script Date: 6/10/2021 1:54:21 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


ALTER   PROCEDURE [dbo].[BLS_DWOCB_WWH] @wid int, @pfdate datetime, @ptdate datetime, @fdate datetime, @tdate datetime
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
t1.paprice as avgprice,
(
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and t3.status = 1 and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @ptdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and t3.status = 1 and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @ptdatev )
) as stockqty,


((
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and t3.status = 1 and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @ptdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and t3.status = 1 and convert(varchar(10),t3.vchdate, 121)  between  @pfdatev and @ptdatev )
) * (t1.paprice)) as stockamount

from products as t1  join productunittypes as t2 on t2.id = t1.productunittype_id
),
cte00 as( 
select t1.id as id, t1.name_en, t1.productcode as code, t2.name_en as unittype, t2.code as unitcode, 
t1.caprice as avgprice,
(
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and t3.status = 1 and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and t3.status = 1 and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev )
) as stockqty,


((
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  purchasedetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and t3.status = 1 and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev ) 
-
(select (case when sum(t3.quantity) is null then 0 else sum(t3.quantity) end) from  saledetails as t3 where t1.id = t3.product_id and t3.warehouse_id = @whid and t3.status = 1 and convert(varchar(10),t3.vchdate, 121)  between  @fdatev and @tdatev )
) * (t1.caprice)) as stockamount

from products as t1  join productunittypes as t2 on t2.id = t1.productunittype_id
),


pascte as (
    select sum(t1.clbdebit) as tdebit from accjaopenbalances as t1 where t1.warehouse_id = @whid and t1.parent_id = 0 and accstatus = 1
),
fascte as (
    select sum(t1.clbdebit) as tdebit from accjaopenbalances as t1 where t1.warehouse_id = @whid and t1.astype = 1
),
cascte as (
    select sum(t1.clbdebit) as tdebit from accjaopenbalances as t1 where t1.warehouse_id = @whid and t1.astype = 2
),
cashcte as (
    select sum(t1.clbdebit) as tdebit from accjaopenbalances as t1 where t1.warehouse_id = @whid and t1.whereto = 1
),

-- new code
dtrcte as (
    select sum(t1.clbdebit) as tdebit from accjaopenbalances as t1 where t1.warehouse_id = @whid and t1.sundry = 1
),
bankcte as (
    select sum(t1.clbdebit) as tdebit from accjaopenbalances as t1 where t1.warehouse_id = @whid and t1.whereto = 2
),


asrescte as(
    select t1.tdebit as passet,

    (select t1.tdebit from fascte as t1) as fasset,

    (select t1.tdebit from cascte as t1) as casset,
    (select t1.tdebit from cashcte as t1) as cash,
    
    (select t1.tdebit from bankcte as t1) as bank,
    (select t1.tdebit from dtrcte as t1) as debtor -- new code
    
    from  pascte as t1
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

--new code
ctetl as (
select (sum(t1.clbcredit) - 
(select sum(t2.clbcredit) from accjaopenbalances as t2 where t2.accstatus = 2 and t2.warehouse_id = @whid and t2.sundry = 2)
) as tliabilities
from accjaopenbalances as t1
where t1.accstatus = 2  and t1.warehouse_id = @whid
),


--ctetll as (
--select sum(t1.clbcredit) as tliabilities
--from accjaopenbalances as t1
--where t1.accstatus = 2  and t1.warehouse_id = @whid
--),

--new code
ctetcdtr as (
select sum(t1.clbcredit) as tcreditors
from accjaopenbalances as t1 where t1.accstatus = 2  and t1.warehouse_id = @whid and sundry = 2
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
(select (case when t8.tliabilities is null then 0 else t8.tliabilities end) from ctetl as t8) as liabilities,
(select (case when t9.tcreditors is null then 0 else t9.tcreditors end) from ctetcdtr as t9) as creditors --new code

from cte1 as t1
),

 cte8 as(
select 

openingstock, purchase, dexpense, 

closingstock, sale, dincome,

((openingstock + purchase + dexpense) - (closingstock + sale + dincome)) as grosslossco,

((openingstock + purchase + dexpense) - (closingstock + sale + dincome)) as grosslossbf,
indexpense,indincome,asset,liabilities, creditors --new code
from cte7

),
cte9 as (
select 
openingstock, purchase, dexpense, closingstock, sale, dincome,grosslossco,grosslossbf,indexpense,indincome,

((indincome - (grosslossbf)) - (indexpense)) as netprofit,asset,liabilities,creditors,
(select t1.passet from asrescte as t1) as passet,(select t1.fasset from asrescte as t1) as fasset,(select t1.casset from asrescte as t1) as casset,
(select t1.cash from asrescte as t1) as cash, 
(select t1.bank from asrescte as t1) as bank,
(select t1.debtor from asrescte as t1) as debtors --new code


from cte8
)

select openingstock, purchase, dexpense, closingstock, sale, dincome,grosslossco,grosslossbf,
indexpense,indincome,netprofit,

((grosslossbf) + (indexpense) + (netprofit) ) as totlaexpense,

indincome as totalincome,asset,liabilities,passet, fasset,casset,cash,bank,creditors,debtors

from cte9;


END

--Exec BLS_DWOCB_WWH @wid = 9, @pfdate = '2021-01-01', @ptdate = '2021-04-01', @fdate = '2021-04-02', @tdate = '2021-04-15';

--DROP PROCEDURE BLS_DWOCB_WWH



