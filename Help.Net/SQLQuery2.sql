USE [Mordern]
GO

/****** Object:  Table [dbo].[customers]    Script Date: 1/26/2020 12:08:18 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[customers](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](64) NULL,
	[address] [nvarchar](512) NULL,
	[cpersion] [nvarchar](128) NULL,
	[contact] [nvarchar](32) NULL,
	[user_id] [bigint] NULL,
	[upuser_id] [bigint] NULL CONSTRAINT [DF_customers_upuser_id]  DEFAULT ((0)),
	[code] [bigint] NULL CONSTRAINT [DF__customers__code__19CACAD2]  DEFAULT (((ident_current('customers')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
 CONSTRAINT [PK__customers__3213E83F415677D9] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO


CREATE TABLE customers (
	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	name NVARCHAR(64) NULL,
	address NVARCHAR(256) NULL,
	cpersion NVARCHAR(64) NULL,
	contact NVARCHAR(32) NULL,
	user_id BIGINT DEFAULT NULL,
	upuser_id BIGINT DEFAULT 0,
	receivables DECIMAL(18, 2) DEFAULT 0,
	payables DECIMAL(18, 2) DEFAULT 0,
	code BIGINT DEFAULT (((ident_current('customers')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	created_at DATETIME DEFAULT NULL,
	updated_at DATETIME DEFAULT NULL,
)



  ALTER TRIGGER tr_users_delete ON users 
  FOR DELETE
  AS
  BEGIN
  	Declare @affected_id BIGINT;
	Declare @name NVARCHAR(64);
	Declare @email NVARCHAR(64);
	Declare @username NVARCHAR(64);
	Declare @password NVARCHAR(64);
	Declare @address NVARCHAR(512);
	Declare @photo NVARCHAR(128);
	Declare @ulevel NVARCHAR(64);
	Declare @status BIT;
	Declare @whomadeby_id BIGINT;
	Declare @branch_id BIGINT;

	Select @affected_id = id, @name = name, @email=email, @username = username, 
	@password = password, @address = address, @photo = photo, @ulevel = ulevel, @whomadeby_id = whomadeby_id, @branch_id = branch_id from deleted;

	insert into triggerdeleteusers (affected_id, name, email, username, password, address, photo, ulevel, whomadeby_id, branch_id)
	
	values(Cast(@affected_id as bigint),Cast(@name as nvarchar(64)),Cast(@email as nvarchar(64)),Cast(@username as nvarchar(64)),
	Cast(@password as nvarchar(64)),Cast(@address as nvarchar(512)),
	Cast(@photo as nvarchar(128)),Cast(@ulevel as nvarchar(64)),Cast(@whomadeby_id as bigint),
	Cast(@branch_id as bigint))

	insert into userlogs (user_id, status, table_id, affected_id) 
	values (Cast(@whomadeby_id as bigint), Cast(2 as bit), Cast(1 as int), Cast(@affected_id as bigint))

  END






CREATE TABLE chartofaccounts (
	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	code BIGINT DEFAULT (((ident_current('chartofaccounts')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	user_id BIGINT DEFAULT NULL,
	name NVARCHAR(64) NULL,
	parent_id BIGINT DEFAULT 0,
	
	created_at DATETIME DEFAULT NULL,
	updated_at DATETIME DEFAULT NULL,
)



insert into accjournalaccounts (accno,user_id,name) values (1000000, 1, 'Assets')






use AccInvCombo
 
truncate table accjournalaccounts

 delete from accjournalaccounts

 select * from accjournalaccounts


  insert into accjournalaccounts (branch_id,accno,user_id,name,parent_id,level) 
  values 
  (3, 1000000, 1, 'Assets',NULL,1),
  (3, 2000000, 1, 'Liabilities',NULL,1),
  (3, 3000000, 1, 'Income',NULL,1),
  (3, 4000000, 1, 'Expense',NULL,1),
  (3, 1000001, 1, 'Current Asset',2,2),
  (3, 1000002, 1, 'Fixed Asset',2,2),
  (3, 2000001, 1, 'Capital Account',3,2),
  (3, 2000002, 1, 'Current Liabilities',3,2),
  (3, 3000001, 1, 'Direct Income',4,2),
  (3, 3000002, 1, 'Indirect Income',4,2),
  (3, 4000001, 1, 'Direct Expense',5,2),
  (3, 4000002, 1, 'Indirect Expense',5,2)




delete from catfirsts;
delete from catseconds;
delete from catthirds;
delete from customerpayments;
delete from customers;
delete from productbrands;
delete from products;
delete from productsummaries;
delete from productunittypes;
delete from purchases;
delete from purchasedetails;
delete from saledetails;
delete from sales;
delete from triggerdeleteusers;
delete from userlogs;
delete from usermenus;
delete from users where id != 1;
delete from vendors;


