<?php



//
//Tree Example - 1
//
declare @brid int = 9;
declare @id int = 19;


with cte as  
(  
  select t1.id as aid,t1.name as ledger, t1.parent_id as parentid
  from accjournalaccounts t1 where t1.id = @id and t1.branch_id = @brid
  union all  
  select t2.id as aid,t2.name as ledger,t2.parent_id as parentid
  from accjournalaccounts t2
    join cte on t2.parent_id = cte.aid and t2.branch_id = @brid
)

--select * from cte;

select t1.aid, t1.ledger, ISNULL( t2.ledger, 'Boss' ) as parent, t1.parentid
from cte as t1 left join cte as t2 on t1.parentid = t2.aid


//
//Tree Example - 1
//



//
//Tree Example -2
//
declare @brid int = 4;
declare @id int = 19;


with cte as  
(  
  select t1.accjournalaccount_id as aid,t1.name as ledger, t1.parent_id as parentid
  from accjaopenbalances t1 where t1.accjournalaccount_id = @id and t1.warehouse_id = @brid
  union all  
  select t2.accjournalaccount_id as aid,t2.name as ledger,t2.parent_id as parentid
  from accjaopenbalances t2
    join cte on t2.parent_id = cte.aid and t2.warehouse_id = @brid
)

--select * from cte;

select t1.aid, t1.ledger, ISNULL( t2.ledger, 'Boss' ) as parent, t1.parentid
from cte as t1 left join cte as t2 on t1.parentid = t2.aid


//
//Tree Example -2
//


//
//Tree Example -3
//

declare @brid int = 9;
--declare @id int = 19;

with cteca0 as(
  select t1.id as id from accjournalaccounts as t1 where t1.branch_id = @brid and t1.name = 'Fixed Asset'
),

cteca1 as  
(  
  select t1.id as aid,t1.name as ledger, t1.parent_id as parentid, t1.clbdebit as clbdebit
  from accjournalaccounts t1 where t1.id = (select id from cteca0) and t1.branch_id = @brid
  union all  
  select t2.id as aid,t2.name as ledger,t2.parent_id as parentid, t2.clbdebit as clbdebit
  from accjournalaccounts t2
    join cteca1 on t2.parent_id = cteca1.aid and t2.branch_id = @brid
)

--select sum(clbdebit) as tdebit from cteca1;

select t1.aid, t1.ledger, ISNULL( t2.ledger, 'Boss' ) as parent, t1.clbdebit
from cteca1 as t1 left join cteca1 as t2 on t1.parentid = t2.aid


//
//Tree Example -3
//









CREATE TABLE ProductCategories(  
    Id int IDENTITY(1,1) NOT NULL,  
    Amount float NOT NULL,  
    ProductCategoryId int NULL,  
    Name VARCHAR(150) NULL)  





INSERT ProductCategories VALUES (100, NULL, N'A1')  
INSERT ProductCategories VALUES (90, NULL, N'A2')  
INSERT ProductCategories VALUES (80, NULL, N'A3')  
INSERT ProductCategories VALUES (20, 1, N'A11')  
INSERT ProductCategories VALUES (30, 1, N'A12')  
INSERT ProductCategories VALUES (10, 1, N'A13')  
INSERT ProductCategories VALUES (70, 2, N'A21')  
INSERT ProductCategories VALUES (50, 2, N'A22')  
INSERT ProductCategories VALUES (5, 4, N'A11.1')  
INSERT ProductCategories VALUES (10, 4, N'A11.2')  
INSERT ProductCategories VALUES (15, 5, N'A12.1')  
INSERT ProductCategories VALUES (20, 5, N'A12.2')  
INSERT ProductCategories VALUES (25, 9, N'A11.1.1')  
INSERT ProductCategories VALUES (30, 9, N'A11.1.2')  
INSERT ProductCategories VALUES (35, 10, N'A11.2.1')  
INSERT ProductCategories VALUES (40, 10, N'A11.2.2')  




with C as  
(  
  select T.id,  
         T.Amount,  
         T.id as RootID  
  from ProductCategories T  
  union all  
  select T.id,  
         T.Amount,  
         C.RootID  
  from ProductCategories T  
    inner join C   
      on T.ProductCategoryId = C.id  
)
  
select T.id,  
       T.ProductCategoryId,  
       T.Name,  
       T.Amount,  
       S.AmountIncludingChildren  
from ProductCategories T  
  inner join (  
             select RootID,  
                    sum(Amount) as AmountIncludingChildren  
             from C  
             group by RootID  
             ) as S  
    on T.id = S.RootID  
order by T.id  
option (maxrecursion 0)  


//with CTE
with cte as  
(  
  select t1.accjournalaccount_id as aid,  
         t1.opnbdebit,  
         t1.opnbcredit,  
         t1.accjournalaccount_id as root_id,  
		 t1.warehouse_id as warehouse_id
  from accjaopenbalances t1 where t1.warehouse_id = 2 
  union all  
  select t2.accjournalaccount_id as aid,  
         t2.opnbdebit,  
         t2.opnbcredit, 
         cte.root_id,
		 cte.warehouse_id 
  from accjaopenbalances t2
    inner join cte   
      on t2.parent_id = cte.aid where t2.warehouse_id = 2
)

  
select 
		t3.accjournalaccount_id as aid,  
		t3.opnbdebit,  
		t3.opnbcredit,  
		t3.name,   
		t4.opnbdebitwithChild  
		t4.opnbcreditwithChild  
from accjaopenbalances t3  
  inner join (  
             select root_id,  
                    sum(opnbdebit) as opnbdebitwithChild  
                    sum(opnbcredit) as opnbcreditwithChild  
             from cte  
             group by root_id  
             ) as t4  
    on t3.accjournalaccount_id = t4.root_id  
order by t3.accjournalaccount_id  
option (maxrecursion 0) 





-- // Jahid code
WITH tree(id, parent_id, accno,name,groupby, debit,credit) AS
(
    --initial part
    SELECT c.id, c.parent_id, c.accno,c.name,c.groupby, jpd.debit,jpd.credit
    FROM accjourpostdetails jpd INNER JOIN accjournalaccounts c ON jpd.accjournalaccount_id = c.id
    UNION ALL
    --recursive part
    SELECT c.id, c.parent_id, c.accno,c.name,c.groupby, t.debit, t.credit
    FROM accjournalaccounts c INNER JOIN tree t ON c.id = t.parent_id
)
SELECT t.accno,t.name,t.groupby, SUM(t.debit) debit, SUM(t.credit) credit
FROM tree t where t.groupby=1
GROUP BY t.accno,t.name,t.groupby
order by t.accno





-- // Trail Balance

with cte as  
(  
  select t1.accjournalaccount_id as aid,t1.opnbdebit,t1.opnbcredit,t1.accjournalaccount_id as root_id
  from accjaopenbalances t1 where t1.warehouse_id = 2 
  union all  
  select t2.accjournalaccount_id as aid,t2.opnbdebit,t2.opnbcredit,cte.root_id
  from accjaopenbalances t2
    inner join cte on t2.parent_id = cte.aid where t2.warehouse_id = 2 
)

--select * from cte;
select t3.id as id,t3.accjournalaccount_id as aid,t3.opnbdebit,t3.opnbcredit,t3.name,t4.opnbdebitwithChild,t4.opnbcreditwithChild
from accjaopenbalances t3
  inner join ( 
  select root_id, sum(opnbdebit) as opnbdebitwithChild, 
  sum(opnbcredit) as opnbcreditwithChild 
  from cte group by cte.root_id ) as t4  
    on t3.accjournalaccount_id = t4.root_id  where t3.warehouse_id = 2 
order by t3.accjournalaccount_id  
option (maxrecursion 0) 



-- // Trail Balance - 1

with cte as  
(  
  select t1.accjournalaccount_id as aid,t1.opnbdebit,t1.opnbcredit,t1.accjournalaccount_id as root_id
  from accjaopenbalances t1 
  

  where t1.warehouse_id = 2 
  union all  
  select t2.accjournalaccount_id as aid,t2.opnbdebit,t2.opnbcredit,
  cte.root_id
  from accjaopenbalances t2
    inner join cte on t2.parent_id = cte.aid where t2.warehouse_id = 2 
)
--select * from cte;
select t3.id as id, t3.accjournalaccount_id as aid, t3.opnbdebit, t3.opnbcredit,
t5.name,t4.opnbdebitwithChild,t4.opnbcreditwithChild
from accjaopenbalances t3 
  join accjournalaccounts t5 on t5.id = t3.accjournalaccount_id
  inner join ( 
  select root_id, sum(opnbdebit) as opnbdebitwithChild, 
  sum(opnbcredit) as opnbcreditwithChild 
  from cte group by cte.root_id ) as t4  
    on t3.accjournalaccount_id = t4.root_id  where t3.warehouse_id = 2 
order by t3.accjournalaccount_id  
option (maxrecursion 0)


-- // Trail Balance - 2

with cte as  
(  
  select t1.accjournalaccount_id as aid,t1.debit,t1.credit,t1.accjournalaccount_id as root_id
  from accjaopenbalances t1 
  

  where t1.warehouse_id = 2 
  union all  
  select t2.accjournalaccount_id as aid,t2.debit,t2.credit,
  cte.root_id
  from accjaopenbalances t2
    inner join cte on t2.parent_id = cte.aid where t2.warehouse_id = 2 
)
--select * from cte;
select t3.id as id, t3.accjournalaccount_id as aid, t3.debit, t3.credit,
t3.opnbdebit, t3.opnbcredit,

t5.name,t4.debitwithChild,t4.debitwithChild
from accjaopenbalances t3 
  join accjournalaccounts t5 on t5.id = t3.accjournalaccount_id
  inner join ( 
  select root_id, sum(debit) as debitwithChild, 
  sum(credit) as creditwithChild 
  from cte group by cte.root_id ) as t4  
    on t3.accjournalaccount_id = t4.root_id  where t3.warehouse_id = 2 
order by t3.accjournalaccount_id  
option (maxrecursion 0)



-- // Trail Balance - 3

declare @whid int = 2;
-- set @whid = 2;
with cte as  
(  
  select t1.accjournalaccount_id as aid,t1.debit,t1.credit,t1.accjournalaccount_id as root_id
  from accjaopenbalances t1 
  
  where t1.warehouse_id = @whid 
  union all  
  select t2.accjournalaccount_id as aid,t2.debit,t2.credit,
  cte.root_id
  from accjaopenbalances t2
    inner join cte on t2.parent_id = cte.aid where t2.warehouse_id = @whid 
)
--select * from cte;
select t3.id as id, t3.accjournalaccount_id as aid, t3.debit, t3.credit,
t3.opnbdebit, t3.opnbcredit,

t5.name,t4.tdebit,t4.tcredit,
from accjaopenbalances t3 
  join accjournalaccounts t5 on t5.id = t3.accjournalaccount_id
  inner join ( 
  select root_id, sum(debit) as tdebit, 
  sum(credit) as tcredit 
  from cte group by cte.root_id ) as t4  
    on t3.accjournalaccount_id = t4.root_id  where t3.warehouse_id = @whid 
order by t3.accjournalaccount_id  
option (maxrecursion 0)





-- // Update accjaopenbalances

with cte as (
  select accjournalaccount_id, sum(debit) as tbebit, sum(credit) as tcredit
  from accjourpostdetails where warehouse_id = @whid
  group by accjournalaccount_id
)

--select * from cte;

update accjaopenbalances set debit = t2.tbebit, credit = t2.tcredit

from accjaopenbalances join (
  select * from cte
) as t2 on t2.accjournalaccount_id = accjaopenbalances.accjournalaccount_id where accjaopenbalances.warehouse_id = @whid 


-- All checking code

update accjaopenbalances set debit = 0, credit = 0
select * from accjaopenbalances where debit > 0;
select * from accjaopenbalances where credit > 0;
select accjournalaccount_id, sum(debit) as tbebit, sum(credit) as tcredit
from accjourpostdetails where warehouse_id = 2
group by accjournalaccount_id;




-- Required
update accjaopenbalances set opnbcredit = 0 where accstatus = 1;
update accjaopenbalances set opnbdebit = 0 where accstatus = 2;
update accjaopenbalances set opnbcredit = 0 where accstatus = 3;
update accjaopenbalances set opnbdebit = 0 where accstatus = 4;




update accjaopenbalances set uopnbdebit = 0, uopnbcredit = 0,
debit = 0, credit = 0,clbdebit = 0, clbcredit = 0;

select * from accjaopenbalances where accjournalaccount_id = 58;

select * from accjaopenbalances where whereto = 1 and warehouse_id =2;

select opnbdebit, opnbcredit, debit, credit, clbdebit, clbcredit, uopnbdebit, uopnbcredit 
from accjaopenbalances where warehouse_id = 2;


Exec TB_Stap_1_1 @wid = 2, @fdate = '2021-01-03', @tdate = '2021-03-31';

Exec TB_Stap_1 @wid = 2, @fdate = '2021-04-01', @tdate = '2021-04-20';



Exec TB_Stap_1_1 @wid = 2, @fdate = '2021-01-01', @tdate = '2021-03-29';

Exec TB_Stap_1 @wid = 2, @fdate = '2021-03-30', @tdate = '2021-04-20';



select opnbdebit, opnbcredit, debit, credit, clbdebit, clbcredit, uopnbdebit, uopnbcredit 
from accjaopenbalances where warehouse_id = 2;
Exec TB_Stap_1 @wid = 2, @fdate = '2021-01-01', @tdate = '2021-03-29';


update accjaopenbalances set uopnbdebit = 0, uopnbcredit = 0,
debit = 0, credit = 0,clbdebit = 0, clbcredit = 0;

select * from accjaopenbalances where warehouse_id = 2;


select sum(opnbdebit) as opnbdebit, sum(opnbcredit) as opnbcredit from accjaopenbalances where accstatus = 1 and warehouse_id = 2;
select sum(opnbdebit) as opnbdebit, sum(opnbcredit) as opnbcredit from accjaopenbalances where accstatus = 2 and warehouse_id = 2;
select sum(opnbdebit) as opnbdebit, sum(opnbcredit) as opnbcredit from accjaopenbalances where accstatus = 3 and warehouse_id = 2;
select sum(opnbdebit) as opnbdebit, sum(opnbcredit) as opnbcredit from accjaopenbalances where accstatus = 4 and warehouse_id = 2;



select 
sum(opnbdebit) as topnbdebit, sum(opnbcredit) as topnbcredit,
sum(uopnbdebit) as tuopnbdebit, sum(uopnbcredit) as tuopnbcredit,
sum(debit) as tdebit, sum(credit) as tcredit,
sum(clbcredit) as tclbcredit, sum(clbcredit) as tclbcredit
from accjaopenbalances where warehouse_id = 2;



select sum(t1.clbdebit) as debit, sum(t1.clbcredit) as credit 
from accjournalaccounts as t1 where t1.accstatus = 2;

select sum(t1.clbdebit) as debit, sum(t1.clbcredit) as credit 
from accjournalaccounts as t1 where t1.accstatus = 1;

select opnbdebit, opnbcredit, debit, credit, clbdebit, clbcredit, uopnbdebit, uopnbcredit 
from accjaopenbalances;

update accjaopenbalances set uopnbdebit = 0, uopnbcredit = 0, opnbdebit = 0, opnbcredit = 0,
debit = 0, credit = 0,clbdebit = 0, clbcredit = 0;

update accjournalaccounts set uopnbdebit = 0, uopnbcredit = 0, opnbdebit = 0, opnbcredit = 0,
debit = 0, credit = 0,clbdebit = 0, clbcredit = 0;


delete from accjourposts;
delete from accjourpostdetails;

delete from proavamounts;
delete from purchases;
delete from purchasedetails;

delete from sales;
delete from saledetails;
