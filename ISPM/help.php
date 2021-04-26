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