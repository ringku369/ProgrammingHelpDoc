<?php 

// To Know about trigger
// https://www.linode.com/docs/databases/mysql/how-to-work-with-triggers-in-mysql-database/	


# Trigger Syntax
DELIMITER $$
CREATE TRIGGER TRIGGER_NAME

TRIGGER_TIME TRIGGER_EVENT // BEFORE or AFTER. // INSERT, UPDATE, or DELETE

ON TABLE_NAME FOR EACH ROW

BEGIN

	[TRIGGER BODY]

END $$

DELIMITER ;
# Trigger Syntax





// Creating a Before Insert Trigger
// 
DELIMITER $$

CREATE TRIGGER before_workcenters_insert
BEFORE INSERT
ON WorkCenters FOR EACH ROW
BEGIN
    DECLARE rowcount INT;
    
    SELECT COUNT(*) 
    INTO rowcount
    FROM WorkCenterStats;
    
    IF rowcount > 0 THEN
        UPDATE WorkCenterStats
        SET totalCapacity = totalCapacity + new.capacity;
    ELSE
        INSERT INTO WorkCenterStats(totalCapacity)
        VALUES(new.capacity);
    END IF; 

END $$

DELIMITER ;




# Creating an After Update Trigger

DELIMITER $$

CREATE TRIGGER After_t_user_Update

AFTER UPDATE

ON t_user FOR EACH ROW

BEGIN
    IF OLD.fullname <> new.fullname THEN
        INSERT INTO t_user_log(t_user_id,fullname)
        VALUES(old.id, new.fullname);
    END IF;

    IF OLD.option_1 <> new.option_1 THEN
        INSERT INTO t_user_log(t_user_id,option_1)
        VALUES(old.id,new.option_1);
    END IF;

    IF OLD.option_2 <> new.option_2 THEN
        INSERT INTO t_user_log(t_user_id,option_2)
        VALUES(old.id,new.option_2);
    END IF;

END $$

DELIMITER ;

# Creating an After Delete TriggerPermalink
# 

DELIMITER $$

CREATE TRIGGER After_product_archiver_Delete

AFTER DELETE

ON products FOR EACH ROW

BEGIN

	INSERT INTO archived_products 
	(product_id, product_name, cost_price, retail_price, availability) 
		VALUES 
	(OLD.product_id, OLD.product_name, OLD.cost_price, OLD.retail_price, OLD.availability);

END $$

DELIMITER ;