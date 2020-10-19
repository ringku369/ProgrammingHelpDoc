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
MODIFY COLUMN column_name datatype; 


ALTER TABLE users
ADD FOREIGN KEY (country_id) REFERENCES countries(id)


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



CREATE TABLE countries (

	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	code BIGINT DEFAULT (((ident_current('countries')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	name NVARCHAR(128) NULL,

	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
)

CREATE TABLE cities (

	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	code BIGINT DEFAULT (((ident_current('cities')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	country_id BIGINT NOT NULL,
	name NVARCHAR(128) NULL,
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
	FOREIGN KEY (country_id) REFERENCES countries(id)
)

CREATE TABLE users (

	id BIGINT IDENTITY(1,1) PRIMARY KEY,
	code BIGINT DEFAULT (((ident_current('users')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	country_id BIGINT NOT NULL,
	city_id BIGINT NOT NULL,
	name NVARCHAR(128) NULL,
	email NVARCHAR(128) NULL,
	roll NVARCHAR(128) NULL,
	username NVARCHAR(128) DEFAULT (((ident_current('users')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	password NVARCHAR(128) NULL,
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
	FOREIGN KEY (country_id) REFERENCES countries(id),
	FOREIGN KEY (city_id) REFERENCES cities(id)
)









Insert into countries (name) values('Bangladesh')
Insert into countries (name) values('India')

Insert into cities (country_id, name) values(1,'Dhaka')
Insert into cities (country_id, name)  values(1,'Rajshahi')
Insert into cities (country_id, name)  values(2,'Mumbai')
Insert into cities (country_id, name)  values(2,'Kalkata')

Insert into users (country_id,city_id, name, email, roll, password) values(1,1,'user1','user1@gmail.com','001','123123')
Insert into users (country_id,city_id, name, email, roll, password) values(1,2,'user2','user2@gmail.com','002','123123')
Insert into users (country_id,city_id, name, email, roll, password) values(2,3,'user3','user3@gmail.com','003','123123')
Insert into users (country_id,city_id, name, email, roll, password) values(2,4,'user4','user4@gmail.com','004','123123')


CREATE TABLE roles (

	Id BIGINT IDENTITY(1,1) PRIMARY KEY,
	Name NVARCHAR(128) NULL
)

CREATE TABLE users (

	Id BIGINT IDENTITY(1,1) PRIMARY KEY,
	Code BIGINT DEFAULT (((ident_current('users')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	Roleid BIGINT NOT NULL,
	Name NVARCHAR(128) NULL,
	Email NVARCHAR(128) NULL,
	Username NVARCHAR(128) DEFAULT (((ident_current('users')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	Password NVARCHAR(128) NULL,
	Createdat DATETIME DEFAULT GETDATE(),
	Updatedat DATETIME DEFAULT GETDATE()
)

CREATE TABLE roleusers (
	Id BIGINT IDENTITY(1,1) PRIMARY KEY,
	Userid BIGINT NOT NULL,
	Roleid BIGINT NOT NULL
)

CREATE TABLE menus (
	Id BIGINT IDENTITY(1,1) PRIMARY KEY,
	UserId BIGINT NOT NULL,
	ParentId BIGINT NOT NULL,
	Code BIGINT DEFAULT (((ident_current('menus')+(1))+CONVERT([varchar](2),getdate(),(101)))+CONVERT([varchar](4),getdate(),(111))),
	Name NVARCHAR(128) NULL,
	Controller NVARCHAR(128) NULL,
	Methode NVARCHAR(128) NULL,
	Status BIT DEFAULT 1,
	Createdat DATETIME DEFAULT GETDATE(),
	Updatedat DATETIME DEFAULT GETDATE()
)



public class MenuMaster
{
    [Key]
    public int MenuIdentity { get; set; }
    public string MenuID { get; set; }
    public string MenuName { get; set; }
    public string Parent_MenuID { get; set; }
    public string User_Roll { get; set; }
    public string MenuFileName { get; set; }
    public string MenuURL { get; set; }
    public string USE_YN { get; set; }
    public DateTime CreatedDate { get; set; }
}




Insert into roles (name) values('Super Admin');
Insert into roles (name) values('Super Admin');

Insert into users (roleid, name, email, password ) values(1,'Mr. Super Admin','superadmin1@gmail.com','123123');
Insert into users (roleid, name, email, password ) values(2,'Mr.Admin1','admin1@gmail.com','123123');
Insert into users (roleid, name, email, password ) values(3,'Mr.User1','user1@gmail.com','123123');

Insert into roleusers (userid,roleid) values(1,1);
Insert into roleusers (userid,roleid) values(2,2);
Insert into roleusers (userid,roleid) values(3,3);

Insert into users (userid,parentid, name, controller, method ) values(1,'*','Privacy','Home','Privacy');

Insert into Menuobjects (ParentId,data) values(0,'Category1');
Insert into Menuobjects (ParentId,data) values(1,'Category2');
Insert into Menuobjects (ParentId,data) values(1,'Category3');
Insert into Menuobjects (ParentId,data) values(2,'Category1-1');
Insert into Menuobjects (ParentId,data) values(2,'Category1-2');
Insert into Menuobjects (ParentId,data) values(4,'Category1-1-1');
Insert into Menuobjects (ParentId,data) values(5,'Category1-2-1');
Insert into Menuobjects (ParentId,data) values(2,'Category2-1');
Insert into Menuobjects (ParentId,data) values(2,'Category2-2');
Insert into Menuobjects (ParentId,data) values(3,'Category3-2');