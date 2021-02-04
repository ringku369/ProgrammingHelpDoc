<?php 

// MYSQL details about string function
// https://www.w3schools.com/sql/sql_ref_mysql.asp




CREATE TABLE categories(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(64) NOT NULL,
    parent_id INT DEFAULT NULL
);


CREATE TABLE Persons (
    Personid int NOT NULL AUTO_INCREMENT,
    LastName varchar(255) NOT NULL,
    FirstName varchar(255),
    Age int,
    PRIMARY KEY (Personid)
);


INSERT INTO categories VALUES('ELECTRONICS',NULL),('TELEVISIONS',1),('TUBE',2),
        ('LCD',2),('PLASMA',2),('PORTABLE ELECTRONICS',1),('MP3 PLAYERS',6),('FLASH',7),
        ('CD PLAYERS',6),('2 WAY RADIOS',6);


with recursive cte (id, name, parent_id) as (
  select     id,
             name,
             parent_id
  from       categories
  where      parent_id = null
  union all
  select     p.id,
             p.name,
             p.parent_id
  from       categories p
  inner join cte
          on p.parent_id = cte.id
)
select * from cte;




# create the table
CREATE TABLE orgcharts(
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(20),
	role VARCHAR(20),
	manager_id INT
);

# insert the rows
INSERT INTO orgcharts VALUES(1,'Matthew','CEO',NULL), 
(2,'Caroline','CFO',1),(3,'Tom','CTO',1),
(4,'Sam','Treasurer',2),(5,'Ann','Controller',2),
(6,'Anthony','Dev Director',3),(7,'Lousie','Sys Admin',3),
(8,'Travis','Senior DBA',3),(9,'John','Developer',6),
(10,'Jennifer','Developer',6),(11,'Maria','Junior DBA',8);

WITH RECURSIVE reporting_chain(id, name, path, level) AS ( 
          SELECT id, name, CAST(name AS CHAR(100)), 1  
          FROM orgcharts 
          WHERE manager_id IS NULL 
          UNION ALL 
          SELECT oc.id, oc.name, CONCAT(rc.path,' -> ',oc.name), rc.level+1 
          FROM reporting_chain rc JOIN orgcharts oc ON rc.id=oc.manager_id) 
       SELECT * FROM reporting_chain ORDER BY level;