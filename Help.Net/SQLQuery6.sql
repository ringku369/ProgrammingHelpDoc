USE [Modern]
GO

CREATE TABLE [dbo].[sales](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[branch_id] [bigint] NOT NULL,
	[customer_id] [bigint] NOT NULL,
	[user_id] [bigint] NOT NULL,
	[upuser_id] [bigint] NULL CONSTRAINT [DF__sales__upuser_id__3EC74557]  DEFAULT ((0)),
	[ispercent] [tinyint] NULL CONSTRAINT [DF__sales__ispercent__3FBB6990]  DEFAULT ((0)),
	[discount] [float] NULL CONSTRAINT [DF__sales__discount__40AF8DC9]  DEFAULT ((0)),
	[fdiscount] [float] NOT NULL CONSTRAINT [DF_sales_fdiscount]  DEFAULT ((0)),
	[fxdvat] [float] NULL CONSTRAINT [DF_sales_fxdvat]  DEFAULT ((0)),
	[fxdvatamount] [float] NULL CONSTRAINT [DF_sales_fxdamount]  DEFAULT ((0)),
	[vat] [float] NOT NULL CONSTRAINT [DF_sales_vat]  DEFAULT ((0)),
	[tvat] [float] NULL CONSTRAINT [DF_sales_tvat]  DEFAULT ((0)),
	[tdiscount] [float] NULL CONSTRAINT [DF_sales_tdiscount]  DEFAULT ((0)),
	[gtdiscount] [float] NULL CONSTRAINT [DF_sales_gtdiscount]  DEFAULT ((0)),
	[subtotal1] [decimal](18, 2) NULL CONSTRAINT [DF_sales_subtotal1]  DEFAULT ((0)),
	[subtotal] [decimal](18, 2) NULL CONSTRAINT [DF__sales__subtotal__41A3B202]  DEFAULT ((0)),
	[deleverycharge] [float] NULL,
	[payment] [decimal](18, 2) NULL CONSTRAINT [DF__sales__payment__4297D63B]  DEFAULT ((0)),
	[total] [decimal](18, 2) NULL CONSTRAINT [DF__sales__total__438BFA74]  DEFAULT ((0)),
	[grandtotal] [decimal](18, 2) NULL CONSTRAINT [DF__sales__grandtota__44801EAD]  DEFAULT ((0)),
	[lcno] [nvarchar](32) NULL,
	[remarks] [nvarchar](128) NULL,
	[code] [bigint] NULL CONSTRAINT [DF__sales__code__457442E6]  DEFAULT (((ident_current('sales')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	[pstatus] [tinyint] NULL CONSTRAINT [DF_sales_pstatus]  DEFAULT ((0)),
	[isreq] [tinyint] NULL CONSTRAINT [DF_sales_isreq]  DEFAULT ((0)),
	[requisition] [nvarchar](64) NULL,
	[status] [int] NULL CONSTRAINT [DF_sales_status]  DEFAULT ((1)),
	[vchdate] [datetime] NULL,
	[mstatus] [int] NULL CONSTRAINT [DF_sales_mstatus]  DEFAULT ((0)),
	[created_at] [datetime] NULL CONSTRAINT [DF__sales__created_a__4668671F]  DEFAULT (NULL),
	[updated_at] [datetime] NULL CONSTRAINT [DF__sales__updated_a__475C8B58]  DEFAULT (NULL),
 CONSTRAINT [PK__sales__3213E83FB8D6C463] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

CREATE TABLE [dbo].[saledetails](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[sale_id] [bigint] NOT NULL,
	[branch_id] [bigint] NOT NULL,
	[customer_id] [bigint] NOT NULL,
	[user_id] [bigint] NOT NULL,
	[upuser_id] [bigint] NULL CONSTRAINT [DF__saledetai__upuse__4A38F803]  DEFAULT ((0)),
	[catfirst_id] [bigint] NOT NULL,
	[catsecond_id] [bigint] NOT NULL,
	[catthird_id] [bigint] NOT NULL,
	[productbrand_id] [bigint] NOT NULL,
	[productunittype_id] [bigint] NOT NULL,
	[product_id] [bigint] NOT NULL,
	[vat] [float] NULL CONSTRAINT [DF_saledetails_vat]  DEFAULT ((0)),
	[vatValue] [float] NULL CONSTRAINT [DF_saledetails_vatValue]  DEFAULT ((0)),
	[tvatValue] [float] NULL CONSTRAINT [DF_saledetails_tvatValue]  DEFAULT ((0)),
	[disp] [float] NULL CONSTRAINT [DF_saledetails_disp]  DEFAULT ((0)),
	[dispValue] [float] NULL CONSTRAINT [DF_saledetails_dispValue]  DEFAULT ((0)),
	[disa] [float] NULL CONSTRAINT [DF_saledetails_disa]  DEFAULT ((0)),
	[tdiscountValue] [float] NULL CONSTRAINT [DF_saledetails_tdiscountValue]  DEFAULT ((0)),
	[slprice] [float] NULL CONSTRAINT [DF_saledetails_slprice]  DEFAULT ((0)),
	[quantity] [float] NULL CONSTRAINT [DF__saledetai__quant__4B2D1C3C]  DEFAULT ((0)),
	[price] [decimal](18, 2) NULL CONSTRAINT [DF__saledetai__price__4C214075]  DEFAULT ((0)),
	[subtotal] [decimal](18, 0) NULL CONSTRAINT [DF_saledetails_subtotal]  DEFAULT ((0)),
	[total] [decimal](18, 2) NULL CONSTRAINT [DF__saledetai__total__4D1564AE]  DEFAULT ((0)),
	[code] [bigint] NULL CONSTRAINT [DF__saledetail__code__4E0988E7]  DEFAULT (((ident_current('saledetails')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	[isreq] [tinyint] NULL CONSTRAINT [DF_saledetails_isreq]  DEFAULT ((0)),
	[status] [int] NULL CONSTRAINT [DF_saledetails_status]  DEFAULT ((1)),
	[mstatus] [int] NULL CONSTRAINT [DF_saledetails_mstatus]  DEFAULT ((0)),
	[vchdate] [datetime] NULL,
	[created_at] [datetime] NULL CONSTRAINT [DF__saledetai__creat__4EFDAD20]  DEFAULT (NULL),
	[updated_at] [datetime] NULL CONSTRAINT [DF__saledetai__updat__4FF1D159]  DEFAULT (NULL),
 CONSTRAINT [PK__saledeta__3213E83F9671C043] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

CREATE TABLE [dbo].[purchases](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[branch_id] [bigint] NOT NULL,
	[vendor_id] [bigint] NOT NULL,
	[user_id] [bigint] NOT NULL,
	[upuser_id] [bigint] NULL CONSTRAINT [DF__purchases__upuse__3E082B48]  DEFAULT ((0)),
	[vat] [float] NULL CONSTRAINT [DF__purchases__vat__3EFC4F81]  DEFAULT ((0)),
	[subtotal] [decimal](18, 2) NULL CONSTRAINT [DF__purchases__netam__3FF073BA]  DEFAULT ((0)),
	[total] [decimal](18, 2) NULL CONSTRAINT [DF__purchases__gross__40E497F3]  DEFAULT ((0)),
	[grandtotal] [decimal](18, 2) NULL CONSTRAINT [DF_purchases_grandtotal]  DEFAULT ((0)),
	[lcno] [nvarchar](32) NULL,
	[remarks] [nvarchar](128) NULL,
	[code] [bigint] NULL CONSTRAINT [DF__purchases__code__41D8BC2C]  DEFAULT (((ident_current('purchases')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	[isreq] [tinyint] NULL CONSTRAINT [DF_purchases_isreq]  DEFAULT ((0)),
	[requisition] [nvarchar](64) NULL,
	[status] [int] NULL CONSTRAINT [DF_purchases_status]  DEFAULT ((1)),
	[vchdate] [datetime] NULL,
	[mstatus] [int] NULL CONSTRAINT [DF_purchases_mstatus]  DEFAULT ((0)),
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
 CONSTRAINT [PK__purchase__3213E83FC7E28E06] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

CREATE TABLE [dbo].[purchasedetails](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[purchase_id] [bigint] NOT NULL,
	[branch_id] [bigint] NOT NULL,
	[vendor_id] [bigint] NOT NULL,
	[user_id] [bigint] NOT NULL,
	[upuser_id] [bigint] NULL CONSTRAINT [DF__purchased__upuse__469D7149]  DEFAULT ((0)),
	[catfirst_id] [bigint] NOT NULL,
	[catsecond_id] [bigint] NOT NULL,
	[catthird_id] [bigint] NOT NULL,
	[productbrand_id] [bigint] NOT NULL,
	[productunittype_id] [bigint] NOT NULL,
	[product_id] [bigint] NOT NULL,
	[quantity] [float] NULL CONSTRAINT [DF__purchased__quant__47919582]  DEFAULT ((0)),
	[price] [decimal](18, 2) NULL CONSTRAINT [DF__purchased__price__4885B9BB]  DEFAULT ((0)),
	[total] [decimal](18, 2) NULL CONSTRAINT [DF__purchased__total__4979DDF4]  DEFAULT ((0)),
	[code] [bigint] NULL CONSTRAINT [DF__purchasede__code__4A6E022D]  DEFAULT (((ident_current('purchasedetails')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	[isreq] [tinyint] NULL CONSTRAINT [DF_purchasedetails_isreq]  DEFAULT ((0)),
	[status] [int] NULL CONSTRAINT [DF_purchasedetails_status]  DEFAULT ((1)),
	[mstatus] [int] NULL CONSTRAINT [DF_purchasedetails_mstatus]  DEFAULT ((0)),
	[vchdate] [datetime] NULL,
	[created_at] [datetime] NULL CONSTRAINT [DF__purchased__creat__4B622666]  DEFAULT (NULL),
	[updated_at] [datetime] NULL CONSTRAINT [DF__purchased__updat__4C564A9F]  DEFAULT (NULL),
 CONSTRAINT [PK__purchase__3213E83FDD8ED475] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO


use Modern

select * from settings; 

update settings set 
company = 'Modern Herbal Group',
address = '2/1 Shahid Tazuddin Ahmad Sharani
Rhine Razzak Plaza, <br /> 3rd and 4th Floor
Herbal Market,<br /> Moghbazar, Dhaka-1217
Bangladesh.',
mobile = '88-02-9357052 | 88-02-9348020',
email = 'info@modernharbal.com' where id = 1


