USE studentlist3;

CREATE DATABASE studentlist3;
DROP DATABASE studentlist3;
DROP TABLE table_name

TRUNCATE TABLE employees;

CREATE TABLE table_name (
    column1 datatype constraint,
    column2 datatype constraint,
    column3 datatype constraint,
    ....
);


ALTER TABLE table_name
DROP COLUMN column_name;
ADD column_name datatype;
ALTER COLUMN column_name datatype; 


SELECT IDENT_CURRENT('users') + 1;
SELECT IDENT_INCR('users');

ALTER TABLE users
ADD code BIGINT DEFAULT (((ident_current('users')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111)));




The following constraints are commonly used in SQL:

    NOT NULL - Ensures that a column cannot have a NULL value
    UNIQUE - Ensures that all values in a column are different
    PRIMARY KEY - A combination of a NOT NULL and UNIQUE. Uniquely identifies each row in a table
    FOREIGN KEY - Uniquely identifies a row/record in another table
    CHECK - Ensures that all values in a column satisfies a specific condition
    DEFAULT - Sets a default value for a column when no value is specified
    INDEX - Used to create and retrieve data from the database very quickly


CREATE TABLE users (
	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	name NVARCHAR(64) NULL,
	email NVARCHAR(64) UNIQUE,
	username NVARCHAR(64) UNIQUE,
	password NVARCHAR(64) NOT NULL,
	hashpassword VARBINARY(64) NOT NULL,
	address NVARCHAR(512) NULL,
	photo NVARCHAR(128) NULL,
	ulevel INT NOT NULL,
	status BIT DEFAULT 1,
	whomadeby_id BIGINT NOT NULL,
	branch_id BIGINT DEFAULT 0,
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
)


CREATE TABLE sales (
	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	branch_id BIGINT NOT NULL,
	vendor_id BIGINT NOT NULL,
	user_id BIGINT NOT NULL,
	upuser_id BIGINT DEFAULT 0,
	ispercent tinyint DEFAULT 0,
	discount FLOAT DEFAULT 0,
	subtotal DECIMAL(18, 2) DEFAULT 0,
	payment DECIMAL(18, 2) DEFAULT 0,
	total DECIMAL(18, 2) DEFAULT 0,
	grandtotal DECIMAL(18, 2) DEFAULT 0,
	lcno NVARCHAR(32) NULL,
	remarks NVARCHAR(128) NULL,
	code BIGINT DEFAULT (((ident_current('sales')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	created_at DATETIME DEFAULT NULL,
	updated_at DATETIME DEFAULT NULL,
)

CREATE TABLE saledetails (
	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	sale_id BIGINT NOT NULL,
	branch_id BIGINT NOT NULL,
	vendor_id BIGINT NOT NULL,
	user_id BIGINT NOT NULL,
	upuser_id BIGINT DEFAULT 0,

	catfirst_id BIGINT NOT NULL,
	catsecond_id BIGINT NOT NULL,
	catthird_id BIGINT NOT NULL,
	productbrand_id BIGINT NOT NULL,
	productunittype_id BIGINT NOT NULL,
	product_id BIGINT NOT NULL,

	quantity INT DEFAULT 0,
	price DECIMAL(18, 2) DEFAULT 0,
	total DECIMAL(18, 2) DEFAULT 0,

	code BIGINT DEFAULT (((ident_current('saledetails')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	created_at DATETIME DEFAULT NULL,
	updated_at DATETIME DEFAULT NULL,
)



CREATE TABLE customerpayments (
	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	customer_id BIGINT NOT NULL,
	sale_id BIGINT NOT NULL,
	branch_id BIGINT NOT NULL,
	user_id BIGINT NOT NULL,
	netamount DECIMAL(18, 2) DEFAULT 0,
	payment DECIMAL(18, 2) DEFAULT 0,
	remarks NVARCHAR(128) NULL,
	code BIGINT DEFAULT (((ident_current('sales')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	status BIT DEFAULT 0,
	created_At DATETIME DEFAULT GETDATE(),
	updated_At DATETIME DEFAULT GETDATE(),
)


CREATE TABLE networks (
	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	branch_id BIGINT NOT NULL,
	user_id BIGINT NOT NULL,
	code BIGINT DEFAULT (((ident_current('networks')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	
	name NVARCHAR(128) NULL,
	serverip NVARCHAR(128) NULL,
	remarks NVARCHAR(128) NULL,
	status BIT DEFAULT 0,
	created_At DATETIME DEFAULT GETDATE(),
	updated_At DATETIME DEFAULT GETDATE(),
)

CREATE TABLE ispzones (
	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	branch_id BIGINT NOT NULL,
	ispnetwork_id BIGINT NOT NULL,
	code BIGINT DEFAULT (((ident_current('ispzones')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	
	name NVARCHAR(128) NULL,
	status BIT DEFAULT 1,
	created_At DATETIME DEFAULT GETDATE(),
	updated_At DATETIME DEFAULT GETDATE(),
)

CREATE TABLE ispsubzones (
	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	branch_id BIGINT NOT NULL,
	ispzone_id BIGINT NOT NULL,
	code BIGINT DEFAULT (((ident_current('ispsubzones')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	
	name NVARCHAR(128) NULL,
	status BIT DEFAULT 1,
	created_At DATETIME DEFAULT GETDATE(),
	updated_At DATETIME DEFAULT GETDATE(),
)

CREATE TABLE ispboxes (
	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	branch_id BIGINT NOT NULL,
	ispsubzone_id BIGINT NOT NULL,
	code BIGINT DEFAULT (((ident_current('ispboxes')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	
	name NVARCHAR(128) NULL,
	status BIT DEFAULT 1,
	created_At DATETIME DEFAULT GETDATE(),
	updated_At DATETIME DEFAULT GETDATE(),
)

CREATE TABLE isppackages(
	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	branch_id BIGINT NOT NULL,
	ispnetwork_id BIGINT NOT NULL,
	ispsubzone_id BIGINT NOT NULL,
	code BIGINT DEFAULT (((ident_current('isppackages')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	
	name NVARCHAR(128) NULL,
	bandwidth NVARCHAR(128) NULL,
	status BIT DEFAULT 1,

	maintariff DECIMAL(18, 2) DEFAULT 0,
	clienttariff DECIMAL(18, 2) DEFAULT 0,

	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
)


CREATE TABLE ispclients(
	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	branch_id BIGINT NOT NULL,
	ispnetwork_id BIGINT NOT NULL,
	ispzone_id BIGINT NULL,
	ispsubzone_id BIGINT NULL,
	ispbox_id BIGINT NULL,
	isppackage_id BIGINT NULL,

	code BIGINT DEFAULT (((ident_current('ispclients')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	
	fullname NVARCHAR(128) NULL,
	username NVARCHAR(128) NULL,
	password NVARCHAR(128) NULL,

	rusername NVARCHAR(128) NULL,
	rpassword NVARCHAR(128) NULL,
	profile NVARCHAR(128) NULL,
	service NVARCHAR(128) NULL,
	
	status BIT DEFAULT 1,
	status1 BIT DEFAULT 1,

	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
)


CREATE TABLE ispclientpayments(
	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	branch_id BIGINT NOT NULL,
	ispnetwork_id BIGINT NOT NULL,
	ispzone_id BIGINT NULL,
	ispsubzone_id BIGINT NULL,
	ispbox_id BIGINT NULL,
	ispclient_id BIGINT NULL,
	isppackage_id BIGINT NULL,
	
	code BIGINT DEFAULT (((ident_current('ispclientpayments')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	
	bill DECIMAL(18, 2) DEFAULT 0,
	
	status BIT DEFAULT 1,

	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
)


CREATE TABLE ispclientinvoices(
	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	branch_id BIGINT NOT NULL,
	ispnetwork_id BIGINT NOT NULL,
	ispzone_id BIGINT NULL,
	ispsubzone_id BIGINT NULL,
	ispbox_id BIGINT NULL,
	ispclient_id BIGINT NULL,
	isppackage_id BIGINT NULL,
	code BIGINT DEFAULT (((ident_current('ispclientinvoices')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	
	packagebill FLOAT DEFAULT 0,

	fromdate DATETIME DEFAULT GETDATE(),
	todate DATETIME DEFAULT GETDATE(),
	totalday DATETIME DEFAULT GETDATE(),

	billperday FLOAT DEFAULT 0,

	curentdate DATETIME DEFAULT GETDATE(),
	
	daycount INT DEFAULT 1,

	toalbill FLOAT DEFAULT 0,
	balance FLOAT DEFAULT 0,

	status BIT DEFAULT 1,

	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
)










CREATE TABLE Users (
	ID BIGINT IDENTITY(1,1) PRIMARY KEY,
	Name NVARCHAR(64) NULL,
	Email NVARCHAR(64) UNIQUE,
	UserName NVARCHAR(64) UNIQUE,
	Password NVARCHAR(64) NOT NULL,
	PasswordHash VARBINARY(64) NOT NULL,
	Address NVARCHAR(512) NULL,
	Level INT NOT NULL,
	Status BIT DEFAULT 1,
	Created_At DATETIME DEFAULT GETDATE(),
	Updated_At DATETIME DEFAULT GETDATE(),
)


CREATE TABLE States (

	ID BIGINT IDENTITY(1,1) PRIMARY KEY,
	Country_ID INT NOT NULL,
	Name NVARCHAR(128) NULL,
	Status TINYINT DEFAULT 1,
	Created_At DATETIME DEFAULT GETDATE(),
	Updated_At DATETIME DEFAULT GETDATE(),

	FOREIGN KEY (Country_ID) REFERENCES Countries(ID)

)

CREATE TABLE Cities (

	ID BIGINT IDENTITY(1,1) PRIMARY KEY,
	Country_ID INT NOT NULL,
	State_ID INT NOT NULL,
	Name NVARCHAR(128) NULL,
	Status TINYINT DEFAULT 1,
	Created_At DATETIME DEFAULT GETDATE(),
	Updated_At DATETIME DEFAULT GETDATE(),

	FOREIGN KEY (Country_ID) REFERENCES Countries(ID),
	FOREIGN KEY (State_ID) REFERENCES States(ID)

)


CREATE TABLE countries (

	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	name NVARCHAR(128) NULL,
)

CREATE TABLE cities (

	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	country_id INT NOT NULL,
	name NVARCHAR(128) NULL,
	//FOREIGN KEY (country_id) REFERENCES countries(id),
)





CREATE TABLE countries (

	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	name NVARCHAR(128) NULL,
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
)

CREATE TABLE cities (

	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	country_id BIGINT NOT NULL,
	name NVARCHAR(128) NULL,
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
	//FOREIGN KEY (country_id) REFERENCES countries(id)
)

CREATE TABLE departments (

	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	name NVARCHAR(128) NULL,
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE()
)


CREATE TABLE stidents (

	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	code BIGINT DEFAULT (((ident_current('stidents')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	
	country_id BIGINT NOT NULL,
	city_id BIGINT NOT NULL,
	village_id BIGINT NOT NULL,
	department_id BIGINT NOT NULL,
	name NVARCHAR(128) NULL,
	email NVARCHAR(128) NULL,
	father NVARCHAR(64) NULL,
	mother NVARCHAR(64) NULL,
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
)




CREATE TABLE categories (

	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	code BIGINT DEFAULT (((ident_current('categories')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	name NVARCHAR(128) NULL,
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
)

CREATE TABLE subcategories (

	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	code BIGINT DEFAULT (((ident_current('subcategories')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	category_id BIGINT NOT NULL,
	name NVARCHAR(128) NULL,
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
)


CREATE TABLE maincategories (

	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	code BIGINT DEFAULT (((ident_current('maincategories')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	subcategory_id BIGINT NOT NULL,
	name NVARCHAR(128) NULL,
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
)


CREATE TABLE products (

	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	code BIGINT DEFAULT (((ident_current('products')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	maincategory_id BIGINT NOT NULL,
	name NVARCHAR(128) NULL,

	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
)


CREATE TABLE purchases (

	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	code BIGINT DEFAULT (((ident_current('purchases')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	
	vchno NVARCHAR(128) NULL,

	totalprice decimal(18, 2) DEFAULT 0,
	totalqty decimal(18, 2) DEFAULT 0,

	remarks NVARCHAR(128) NULL,
	status BIT DEFAULT 1,
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
)

CREATE TABLE purchasedetails (

	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	code BIGINT DEFAULT (((ident_current('purchasedetails')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	purchase_id BIGINT NOT NULL,
	product_id BIGINT NOT NULL,

	price decimal(18, 2) DEFAULT 0,
	qty decimal(18, 2) DEFAULT 0,
	status BIT DEFAULT 1,
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
)


CREATE TABLE sales (

	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	code BIGINT DEFAULT (((ident_current('sales')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	vchno NVARCHAR(128) NULL,

	product_id BIGINT NOT NULL,

	totalprice decimal(18, 2) DEFAULT 0,
	totalqty decimal(18, 2) DEFAULT 0,

	remarks NVARCHAR(128) NULL,

	status BIT DEFAULT 1,
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
)

CREATE TABLE saledetails (

	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	code BIGINT DEFAULT (((ident_current('sales')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	sale_id BIGINT NOT NULL,
	product_id BIGINT NOT NULL,

	price decimal(18, 2) DEFAULT 0,
	qty decimal(18, 2) DEFAULT 0,
	status BIT DEFAULT 1,
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
)



CREATE TABLE accrelations (

	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	branch_id BIGINT DEFAULT NULL,
	code BIGINT DEFAULT (((ident_current('accrelations')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	name NVARCHAR(128) NULL,
	
	status BIT DEFAULT 1,
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
)



CREATE TABLE acchcrmaps (
	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	branch_id BIGINT DEFAULT NULL,
	code BIGINT DEFAULT (((ident_current('acchcrmaps')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	accrelation_id BIGINT DEFAULT NULL,
	accjournalaccount_id BIGINT DEFAULT NULL,
	status BIT DEFAULT 1,
	created_at DATETIME DEFAULT getdate(),
	updated_at DATETIME DEFAULT getdate(),
)


CREATE TABLE stores (

	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	branch_id BIGINT DEFAULT NULL,
	code BIGINT DEFAULT (((ident_current('stores')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	name NVARCHAR(128) NULL,
	
	status BIT DEFAULT 1,
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
)


CREATE TABLE accfyears (
	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	branch_id BIGINT DEFAULT NULL,
	code BIGINT DEFAULT (((ident_current('accfyears')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	fromdate DATE DEFAULT getdate(),
	todate DATE DEFAULT getdate(),
	status BIT DEFAULT 1,
	created_at DATETIME DEFAULT getdate(),
	updated_at DATETIME DEFAULT getdate(),
)




Insert into countries values('Bangladesh')
Insert into countries values('India')

Insert into cities values(1,'Dhaka')
Insert into cities values(1,'Rajshahi')
Insert into cities values(2,'Mumbai')
Insert into cities values(2,'Kalkata')

select * from countries
select * from cities




//===================
protected DataSet ExecuteDataSet(string query)
{
    using (SqlConnection con = new SqlConnection(CS))
    {
        con.Open();
        SqlDataAdapter da = new SqlDataAdapter(query, con);
        DataSet ds = new DataSet();
        da.Fill(ds);

        return ds;
    }

}
//===================
//===================
string query = @"select id from usermenus where user_id = '"+id+"' AND parent = '"+ ChildNodeItem.Parent.Text + "' AND child = '"+ ChildNodeItem.Text + "' AND nurl = '"+ ChildNodeItem.NavigateUrl + "' ";
DataSet dsResult = ExecuteDataSet(query);
int count = dsResult.Tables[0].Rows.Count;
//===================

//======================================

CREATE TRIGGER tr_users_delete ON users 
FOR INSERT
AS
BEGIN
	select * from inserted
END

//======================================

  CREATE TRIGGER tr_users_delete ON users 
  FOR DELETE
  AS
  BEGIN
	Declare @name NVARCHAR;
	Declare @email NVARCHAR;

	Select @name = name, @email=email from deleted;

	insert into trdeleteusers (name, email)
	values(Cast(@name as nvarchar(64)),Cast(@email as nvarchar(64)))

  END

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


SELECT TOP 1000 [id]
      ,[user_id]
      ,[status]
      ,[table_id]
      ,[affected_id]
      ,[created_at]
      ,[updated_at]
  FROM [demodb].[dbo].[userlogs]


delete from usermenus where user_id = 2

insert into Users (name,email,username,password,hashpassword,ulevel,whomadeby_id,branch_id) 
	Values ('Mr. Super Admin','superadmin@yahoo.com','superadmin','superadmin',HashBytes('SHA2_256', 'superadmin'),100000,1,2);


insert into Users (Name,Email,UserName,Password,PasswordHash,Level) 
	Values ('Mr. Admin','admin@yahoo.com','Admin','Admin',HashBytes('SHA2_256', 'Admin'),1000);


insert into usermenus (user_id,parent,child,nurl) 
	Values 
	(2,'Products','Add Products','~/AddProducts');

select * from Users where PasswordHash = HashBytes('SHA2_256', 'Admin');

select * from Users;

select T1.Name as Country, T2.Name as City
from Countries as T1
join Cities as T2 on T1.ID = T2.Country_ID


select T2.name as Country, T1.Name as City
from Cities as T1
join Countries as T2 on T1.Country_ID = T2.ID








