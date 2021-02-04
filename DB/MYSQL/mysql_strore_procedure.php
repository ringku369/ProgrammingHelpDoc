 <?php

// To Know about trigger
// https://www.mysqltutorial.org/mysql-stored-procedure-tutorial.aspx/
// 

# Example 0 =========
# 
# 

$fdate = "2020-12-18";
$todate = "2020-12-20";

$query = DB::select("CALL GetRegistersWithParam(?,?)",array($fdate,$todate));
$results = json_decode(json_encode($query), True);



# Example 1 =========
# 
# 
DELIMITER $$

CREATE OR REPLACE PROCEDURE GetCustomers()
BEGIN
	SELECT 
		customerName, 
		city, 
		state, 
		postalCode, 
		country
	FROM
		customers
	ORDER BY customerName;    
END$$
DELIMITER ;

CALL GetCustomers();



# Example 2 =========
# 
# 

DELIMITER $$

CREATE PROCEDURE GetTotalOrder()
BEGIN
	DECLARE totalOrder INT DEFAULT 0;
    
    SELECT COUNT(*) 
    INTO totalOrder
    FROM orders;
    
    SELECT totalOrder;
END$$

DELIMITER ;


SELECT totalOrder;

CALL GetTotalOrder();


# Example 3 =========
# 
# 

DROP PROCEDURE GetUsersWithParam;

DELIMITER $$

CREATE OR REPLACE PROCEDURE GetUsersWithParam(
	IN userid INT(11), useremail VARCHAR(128)
)
BEGIN
	SELECT * FROM users WHERE id = userid AND email = useremail ORDER BY id ASC;
END$$
DELIMITER ;
CALL GetUsersWithParam(1,'admin@yahoo.com');


# Example 4 =========
# 
#

DROP PROCEDURE GetRegisters;

DELIMITER $$

CREATE OR REPLACE PROCEDURE GetRegisters()
BEGIN
	SELECT * FROM registers ORDER BY id ASC;
END$$
DELIMITER ;

CALL GetRegisters;




# Example 5 =========
# 
#

DELIMITER $$
CREATE OR REPLACE PROCEDURE GetRegistersWithParam(
	IN fdate VARCHAR(64), todate VARCHAR(64)
)
BEGIN
	SELECT * FROM registers 
	WHERE DATE_FORMAT(created_at,'%Y-%m-%d') BETWEEN fdate AND todate ORDER BY id ASC;
END$$
DELIMITER ;

CALL GetRegistersWithParam('2020-12-18','2020-12-20');







