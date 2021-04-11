<?php

USE ispm;


delete table proavamounts;

CREATE TABLE proavamounts (

    id BIGINT IDENTITY(1,1) PRIMARY KEY,
    code BIGINT DEFAULT (((ident_current('proavamounts')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),

    branch_id BIGINT NOT NULL,
    warehouse_id BIGINT NOT NULL,
    product_id BIGINT NOT NULL,

    price decimal(18, 2) DEFAULT 0,
    status BIT DEFAULT 1,
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE(),
)


drop table userwhmaps;

CREATE TABLE userwhmaps (

    id BIGINT IDENTITY(1,1) PRIMARY KEY,
    code BIGINT DEFAULT (((ident_current('userwhmaps')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
    branch_id BIGINT NOT NULL,
    warehouse_id BIGINT NOT NULL,
    user_id BIGINT NOT NULL,
    status BIT DEFAULT 1,
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE(),
)



CREATE TABLE [dbo].[accjaopenbalances](
    [id] [bigint] IDENTITY(1,1) NOT NULL,
    [branch_id] [bigint] NOT NULL,
    [code] [bigint] DEFAULT (((ident_current('accjaopenbalances')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
    [accno] [bigint] DEFAULT (((ident_current('accjaopenbalances')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
    [name] [nvarchar](64) NULL,
    [parent_id] [bigint] DEFAULT 0,
    [level] [int] DEFAULT 1,
    [gid1] [int] DEFAULT 0,
    [gid2] [int] DEFAULT 0,
    [gid3] [int] DEFAULT 0,
    [gid4] [int] DEFAULT 0,
    [type] [int] DEFAULT 0,
    [whereto] [int] DEFAULT 0,
    [relation] [int] DEFAULT 0,
    [opnbdebit] [decimal](18, 2) DEFAULT 0,
    [opnbcredit] [decimal](18, 2) DEFAULT 0,
    [clbdebit] [decimal](18, 2) DEFAULT 0,
    [clbcredit] [decimal](18, 2) DEFAULT 0,
    [debit] [decimal](18, 2) DEFAULT 0,
    [credit] [decimal](18, 2) DEFAULT 0,
    [groupby] [int] DEFAULT 0,
    [accstatus] [int] DEFAULT 1,
    [created_at] [datetime] DEFAULT GETDATE(),
    [updated_at] [datetime] DEFAULT GETDATE(),
)




int accjournalaccount_id = Convert.ToInt32(rdr["id"].ToString());
int branch_id = Convert.ToInt32(rdr["branch_id"].ToString());

int parent_id = Convert.ToInt32(rdr["parent_id"].ToString());

string code = rdr["code"].ToString();
string accno = rdr["accno"].ToString();
string name = rdr["name"].ToString();

int level = Convert.ToInt32(rdr["level"].ToString());
int gid1 = Convert.ToInt32(rdr["gid1"].ToString());
int gid2 = Convert.ToInt32(rdr["gid2"].ToString());
int gid3 = Convert.ToInt32(rdr["gid3"].ToString());
int gid4 = Convert.ToInt32(rdr["gid4"].ToString());
int type = Convert.ToInt32(rdr["type"].ToString());
int whereto = Convert.ToInt32(rdr["whereto"].ToString());
int relation = Convert.ToInt32(rdr["relation"].ToString());
int groupby = Convert.ToInt32(rdr["groupby"].ToString());
int accstatus = Convert.ToInt32(rdr["accstatus"].ToString());

double opnbdebit = Convert.ToDouble(rdr["opnbdebit"].ToString());
double opnbcredit = Convert.ToDouble(rdr["opnbcredit"].ToString());
double clbdebit = Convert.ToDouble(rdr["clbdebit"].ToString());
double clbcredit = Convert.ToDouble(rdr["clbcredit"].ToString());
double debit = Convert.ToDouble(rdr["debit"].ToString());
double credit = Convert.ToDouble(rdr["credit"].ToString());



string query1 = @"insert into accjaopenbalances 
(warehouse_id,branch_id,parent_id,code,accno,name,level,
gid1,gid2,id3,gid4,type,whereto,relation,groupby,accstatus,
opnbdebit,opnbcredit,clbdebit,clbcredit,debit,credit) 
                   values 
(@warehouse_id,@branch_id,@parent_id,@code,@accno,@name,@level,
@gid1,@gid2,@gid3,@gid4,@type,@whereto,@relation,@groupby,@accstatus,
@opnbdebit,@opnbcredit,@clbdebit,@clbcredit,@debit,@credit)";



SqlCommand cmd1 = BaseClass.CommandBuilder(query1);
cmd1.Parameters.AddWithValue("@warehouse_id", warehouse_id);
cmd1.Parameters.AddWithValue("@branch_id", branch_id);
cmd1.Parameters.AddWithValue("@parent_id", parent_id);
cmd1.Parameters.AddWithValue("@code", code);
cmd1.Parameters.AddWithValue("@accno", accno);
cmd1.Parameters.AddWithValue("@name", name);
cmd1.Parameters.AddWithValue("@level", level);
cmd1.Parameters.AddWithValue("@gid1", gid1);
cmd1.Parameters.AddWithValue("@gid2", gid2);
cmd1.Parameters.AddWithValue("@gid3", gid3);
cmd1.Parameters.AddWithValue("@gid4", gid4);
cmd1.Parameters.AddWithValue("@type", type);
cmd1.Parameters.AddWithValue("@whereto", whereto);
cmd1.Parameters.AddWithValue("@relation", relation);
cmd1.Parameters.AddWithValue("@groupby", groupby);
cmd1.Parameters.AddWithValue("@accstatus", accstatus);
cmd1.Parameters.AddWithValue("@opnbdebit", opnbdebit);
cmd1.Parameters.AddWithValue("@opnbcredit", opnbcredit);
cmd1.Parameters.AddWithValue("@clbdebit", clbdebit);
cmd1.Parameters.AddWithValue("@clbcredit", clbcredit);
cmd1.Parameters.AddWithValue("@debit", debit);
cmd1.Parameters.AddWithValue("@credit", credit);
int rowCount = cmd1.ExecuteNonQuery();
BaseClass.Con.Close();



