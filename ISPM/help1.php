<?php


ProductBarcode


(('QP'+CONVERT([varchar](12),(9)))+CONVERT([varchar](12),ident_current('products')+(900000)))

(('QP'+CONVERT([varchar](12),(9)))+))


CONVERT([varchar](12),ident_current('products'))

(((ident_current('products')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111)))

use ispm;

//Select======
SqlConnection con = new SqlConnection(CS);
string query = @"select top 1 row_number() over (order by id) as row_number, id, name, code,username, 
serverip, password, remarks, port,
(case status when 0 then 'Inactive' else 'Active' end) as status,
convert(varchar(11),created_at,106) as created_at from ispnetworks where branch_id = '" + branch_id + "' order by id asc";
SqlCommand cmd = new SqlCommand(query, con);
con.Open();

SqlDataReader rdr = cmd.ExecuteReader();
Credential credential = new Credential();
while (rdr.Read())
{
    credential.tikConnectionType = TikConnectionType.Api;
    credential.name = rdr["name"].ToString();
    credential.code = rdr["code"].ToString();
    credential.host = rdr["serverip"].ToString();
    credential.port = Convert.ToInt32(rdr["port"].ToString());
    credential.username = rdr["username"].ToString();
    credential.password = rdr["password"].ToString();
    
}
con.Close();
return credential;
//Select======



-- For Branch

declare @brid int = 9;
declare @pfdatev datetime = '2021-03-03';
declare @ptdatev datetime = '2021-04-01';

declare @fdatev datetime = '2021-04-02';
declare @tdatev datetime = '2021-010-18';


-- opening balance area
with cte1 as (
select (case when sum(t1.debit) is null then 0 else sum(t1.debit) end) as credit, 
(case when sum(t1.credit) is null then 0 else sum(t1.credit) end) as debit
from accjourpostdetails as t1 
where t1.whereto not in (1) and t1.branch_id = @brid
and convert(varchar(10),t1.vchdate, 121)  between  @pfdatev and @ptdatev
group by t1.accjourpost_id
),
cte2 as (
	select (case when debit is null then 0 else debit end) as debit, 
	(case when credit is null then 0 else credit end) as credit
	from cte1 where debit != credit
),

cte3 as (
	select  (case when sum(debit) is null then 0 else sum(debit) end) as tdebit, 
	
	(case when sum(credit) is null then 0 else sum(credit) end) as tcredit  from cte2
),
-- final opening balance value
cte4 as (
	select (tdebit - tcredit) as debit, null as credit from cte3
),
-- opening balance area

-- closing balance area
cte11 as (
select t1.accjourpost_id, (case when sum(t1.debit) is null then 0 else sum(t1.debit) end) as credit, 
(case when sum(t1.credit) is null then 0 else sum(t1.credit) end) as debit
from accjourpostdetails as t1 
where t1.whereto not in (1) and t1.branch_id = @brid
and convert(varchar(10),t1.vchdate, 121)  between  @fdatev and @tdatev
group by t1.accjourpost_id
),
cte22 as (
	select t2.code as vno,convert(varchar(10),t2.vchdate,105) as vchdate, 
	t2.narration as remarks, t3.name as vchtype,
	
	(case when t1.debit is null then 0 else t1.debit end) as debit, 
	(case when t1.credit is null then 0 else t1.credit end) as credit
	from cte11 as t1 

	join accjourposts as t2 on t2.id = t1.accjourpost_id
	join accvchtypes as t3 on t3.id = t2.accvchtype_id
	where t1.debit != t1.credit
),

cte33 as (
	select  (case when sum(debit) is null then 0 else sum(debit) end) as debit, 
	
	(case when sum(credit) is null then 0 else sum(credit) end) as credit  from cte22
),
-- final closing balance value
cte44 as (
	select (debit - credit) as credit, null as debit from cte33
)
-- closing balance area

--select * from cte44;

select FORMAT (@fdatev, 'dd-MM-yyyy') as vchdate, 'Opening Balance' as remarks, null as vchtype, null as vno, debit, credit from cte4
union all 
select vchdate, remarks, vchtype, vno, debit, credit from cte22
union all 
select null as vchdate, null as remarks, null as vchtype, null as vno, debit, credit from cte33
union all 
select FORMAT (@tdatev, 'dd-MM-yyyy') as vchdate, 'Closing Balance' as remarks, null as vchtype, null as vno, debit, credit from cte44
union all
select null as vchdate, null as remarks, null as vchtype, null as vno, debit, debit from cte33







-- For warehouse

declare @whid int = 4;
declare @pfdatev datetime = '2021-03-03';
declare @ptdatev datetime = '2021-04-01';

declare @fdatev datetime = '2021-04-02';
declare @tdatev datetime = '2021-010-18';


-- opening balance area
with cte1 as (
select (case when sum(t1.debit) is null then 0 else sum(t1.debit) end) as credit, 
(case when sum(t1.credit) is null then 0 else sum(t1.credit) end) as debit
from accjourpostdetails as t1 
where t1.whereto not in (1) and t1.warehouse_id = @whid
and convert(varchar(10),t1.vchdate, 121)  between  @pfdatev and @ptdatev
group by t1.accjourpost_id
),
cte2 as (
	select (case when debit is null then 0 else debit end) as debit, 
	(case when credit is null then 0 else credit end) as credit
	from cte1 where debit != credit
),

cte3 as (
	select  (case when sum(debit) is null then 0 else sum(debit) end) as tdebit, 
	
	(case when sum(credit) is null then 0 else sum(credit) end) as tcredit  from cte2
),
-- final opening balance value
cte4 as (
	select (tdebit - tcredit) as debit, null as credit from cte3
),
-- opening balance area

-- closing balance area
cte11 as (
select t1.accjourpost_id, (case when sum(t1.debit) is null then 0 else sum(t1.debit) end) as credit, 
(case when sum(t1.credit) is null then 0 else sum(t1.credit) end) as debit
from accjourpostdetails as t1 
where t1.whereto not in (1) and t1.warehouse_id = @whid
and convert(varchar(10),t1.vchdate, 121)  between  @fdatev and @tdatev
group by t1.accjourpost_id
),
cte22 as (
	select t2.code as vno,convert(varchar(10),t2.vchdate,105) as vchdate, 
	t2.narration as remarks, t3.name as vchtype,
	
	(case when t1.debit is null then 0 else t1.debit end) as debit, 
	(case when t1.credit is null then 0 else t1.credit end) as credit
	from cte11 as t1 

	join accjourposts as t2 on t2.id = t1.accjourpost_id
	join accvchtypes as t3 on t3.id = t2.accvchtype_id
	where t1.debit != t1.credit
),

cte33 as (
	select  (case when sum(debit) is null then 0 else sum(debit) end) as debit, 
	
	(case when sum(credit) is null then 0 else sum(credit) end) as credit  from cte22
),
-- final closing balance value
cte44 as (
	select (debit - credit) as credit, null as debit from cte33
)
-- closing balance area

--select * from cte44;

select FORMAT (@fdatev, 'dd-MM-yyyy') as vchdate, 'Opening Balance' as remarks, null as vchtype, null as vno, debit, credit from cte4
union all 
select vchdate, remarks, vchtype, vno, debit, credit from cte22
union all 
select null as vchdate, null as remarks, null as vchtype, null as vno, debit, credit from cte33
union all 
select FORMAT (@tdatev, 'dd-MM-yyyy') as vchdate, 'Closing Balance' as remarks, null as vchtype, null as vno, debit, credit from cte44
union all
select null as vchdate, null as remarks, null as vchtype, null as vno, debit, debit from cte33

