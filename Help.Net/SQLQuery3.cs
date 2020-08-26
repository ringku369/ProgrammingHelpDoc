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


