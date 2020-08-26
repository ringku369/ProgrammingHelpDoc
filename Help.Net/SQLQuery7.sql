use ISPM

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

delete from productunittypes;
delete from productbrands;
delete from vendors;
delete from customers;

delete from sales;
delete from saledetails;
delete from purchases;
delete from purchasedetails;
delete from customerpayments;



use ISPM

CREATE TABLE accjourposts (
	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	branch_id BIGINT DEFAULT NULL,
	code BIGINT DEFAULT (((ident_current('accjourposts')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	user_id BIGINT DEFAULT NULL,
	vchno NVARCHAR(64) NULL,
	narration NVARCHAR(512) NULL,

	vchdate NVARCHAR(64) NULL,
	vtype int DEFAULT 1,
	whereto int DEFAULT 1,

	debit decimal(18, 2) DEFAULT 0,
	credit decimal(18, 2) DEFAULT 0,

	created_at DATETIME DEFAULT getdate(),
	updated_at DATETIME DEFAULT getdate(),
)



CREATE TABLE [dbo].[accjourpostdetails](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[branch_id] [bigint] NOT NULL,
	[code] [bigint] DEFAULT  (((ident_current('accjourpostdetails')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	[user_id] [bigint] NULL,
	[name] [nvarchar](64) NULL,
	[parent_id] [bigint] NULL,
	[level] [int] DEFAULT 0,
	[gid1] [int] DEFAULT 0,
	[gid2] [int] DEFAULT 0,
	[gid3] [int] DEFAULT 0,
	[gid4] [int] DEFAULT 0,
	[type] [int] DEFAULT 1,
	[whereto] [int] DEFAULT 1,
	[relation] [int] DEFAULT 1,
	[accseting_id] [int] NULL,
	[fdstart] [nvarchar](50) NULL,
	[fdend] [nvarchar](50) NULL,
	[opnbdebit] [decimal](18, 2) DEFAULT 0,
	[opnbcredit] [decimal](18, 2) DEFAULT 0,
	[clbdebit] [decimal](18, 2) DEFAULT 0,
	[clbcredit] [decimal](18, 2) DEFAULT 0,
	[debit] [decimal](18, 2) DEFAULT 0,
	[credit] [decimal](18, 2) DEFAULT 0,
	[groupby] [int] DEFAULT 0,
	[created_at] [datetime] DEFAULT getdate(),
	[updated_at] [datetime] DEFAULT getdate(),
)



