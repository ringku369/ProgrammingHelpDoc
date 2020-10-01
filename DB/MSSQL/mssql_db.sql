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


ALTER TABLE users
FOREIGN KEY (country_id) REFERENCES countries(id)


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