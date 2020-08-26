use AccInvCombo

delete from users where id != 1;
delete from usermenus;
delete from userlogs;
delete from triggerdeleteusers;

delete from triggerdeleteusers;

delete from firstcats;
delete from secondcats;
delete from thirdcats;
delete from products;
delete from productsummaries;
delete from firstcat;

delete from sales;
delete from saledetails;
delete from purchases;
delete from purchasedetails;
delete from customerpayments;


select t1.name as country, t2.name as city
from countries as t1
join cities as t2 on t1.id = t2.country_id


select t2.name as country, t1.name as city
from cities as t1
join countries as t2 on t1.country_id = t2.id


select * from productsummaries where branch_id != 3

delete from productsummaries where branch_id != 3

select count (id) as id, branch_id from productsummaries group by branch_id



CASE WHEN type IS NULL THEN '' ELSE 'N/A' END AS type
CASE WHEN type = 1 THEN 'Direct' WHEN type = 2 THEN 'Indirect' ELSE 'N/A' END AS type
CASE type WHEN 1 THEN 'Direct' WHEN 2 THEN 'Indirect' ELSE 'N/A' END AS type



SELECT * FROM purchasedetails WHERE CONVERT(varchar(10),[created_at],120) BETWEEN '2020-04-12' AND '2020-04-12'


select t1.id as id, t1.parent_id as parent_id, t2.name as name1, t1.name as name, t1.code as code,
convert(varchar(11),t1.created_at,106) as created_at,
CASE WHEN t1.type = 1 THEN 'Direct' WHEN t1.type = 2 THEN 'Indirect' ELSE 'N/A' END as type
from accjournalaccounts as t1 

join accjournalaccounts as t2 ON t2.parent_id = t1.id

where t1.parent_id = 0




select (
(CASE when sum(t1.quantity) IS NULL  then 0 else sum(t1.quantity) end) - 
(select (case when sum(t2.quantity) IS NULL then 0 else sum(t2.quantity) end) 
from saledetails as t2 where t2.product_id = 36 AND t2.branch_id = 3)
) as roqty
from purchasedetails as t1 where t1.product_id = 36 AND t1.branch_id = 3



select ((CASE when sum(t1.quantity) IS NULL  then 0 else 
((select distinct opening_qty from productsummaries where product_id = 36 and branch_id = 3)+ sum(t1.quantity)) end) - 
(select (case when sum(t2.quantity) IS NULL then 0 else sum(t2.quantity) end) 
from saledetails as t2 where t2.product_id = 36 AND t2.branch_id = 3)) as roqty 
from purchasedetails as t1 where t1.product_id = 36 AND t1.branch_id = 3



select 
(
  ( 
    select (case when sum(t2.quantity) IS NULL then 0 else sum(t2.quantity) end) from saledetails as t2 
    where t2.product_id = 36 AND t2.branch_id = 3
  ) -

  (
    CASE when sum(t1.quantity) IS NULL  then 0 else 
    ((select distinct opening_qty from productsummaries where product_id = 36 and branch_id =  3)
    + sum(t1.quantity)) end
  )

) as roqty from purchasedetails as t1 
where t1.product_id = 36 AND t1.branch_id = 3



select (
  ( 
    select (case when sum(t2.quantity) IS NULL then 0 else sum(t2.quantity) end) from saledetails as t2 
    where t2.product_id = 36 AND t2.branch_id = 3
  )

) as roqty from purchasedetails as t1 
where t1.product_id = 36 AND t1.branch_id = 3









select top 1 t2.name as branch, t3.name as vendor, t4.name as whocreter, 
t1.code as code, convert(varchar(11),t1.created_at,106) as created_at,
convert(varchar(19),t1.vchdate,0) as vchdate

select top 1 t2.name as branch, t3.name as vendor, t4.name as whocreter, 
t1.code as code, t1.vat as vat, t1.subtotal as subtotal,
t1.total as total,t1.grandtotal as grandtotal, 
t1.status as status,t1.isreq as isreq,
convert(varchar(11),t1.created_at,106) as created_at,
convert(varchar(19),t1.vchdate,0) as vchdate

from purchases as t1
join branches as t2 on t1.branch_id = t2.id
join vendors as t3 on t1.vendor_id = t3.id
join users as t4 on t1.user_id = t4.id
where t1.id = 18 AND t1.branch_id = 3


/****** Script for SelectTopNRows command from SSMS  ******/
SELECT TOP 1000 [id]
      ,[branch_id]
      ,[user_id]
      ,[parent]
      ,[child]
      ,[nurl]
      ,[status]
      ,[isEditPer]
      ,[isDelPer]
      ,[isDtlPer]
      ,[created_at]
      ,[updated_at]
  FROM [Modern].[dbo].[usermenus] where user_id = 43
update usermenus set isEditPer = 0, isDelPer = 0 where user_id = 43
  update usermenus set branch_id = (select users.branch_id from users where users.id = usermenus.user_id)

  


ActionPermission actionPermission = new ActionPermission();




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

  

  // for action permission code
    if (this._ulevel != 100000)
    {
        //==================
        string _path = HttpContext.Current.Request.Url.AbsolutePath;
        int _isDelPer = actionPermission.IsDelPermission(this._id, _path);

        if (_isDelPer == 0)
        {
            error_area.Visible = true;
            success_area.Visible = false;
            error_msg.Text = "Sorry you are not eligible for this action";
            return;
        }


    }
  // for action permission code



  // for action permission code
    if (this._ulevel != 100000)
    {
        //==================
        string _path = HttpContext.Current.Request.Url.AbsolutePath;
        int _isDtlPer = actionPermission.IsDtlPermission(this._id, _path);

        if (_isDtlPer == 0)
        {
            error_area.Visible = true;
            success_area.Visible = false;
            error_msg.Text = "Sorry you are not eligible for this action";
            return;
        }


    }
  // for action permission code