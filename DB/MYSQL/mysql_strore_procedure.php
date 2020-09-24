 <?php

// To Know about trigger
// https://www.mysqltutorial.org/mysql-stored-procedure-tutorial.aspx/
// 

# Example 1 =========
# 
# 
DELIMITER $$

CREATE PROCEDURE GetCustomers()
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



