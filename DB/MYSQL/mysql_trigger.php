<?php 

// To Know about trigger
// https://www.linode.com/docs/databases/mysql/how-to-work-with-triggers-in-mysql-database/	


# Trigger Syntax
DELIMITER $$
CREATE OR REPLACE TRIGGER TRIGGER_NAME

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

CREATE OR REPLACE TRIGGER before_workcenters_insert
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


// Creating a After Insert Trigger
// 
DELIMITER $$

CREATE OR REPLACE TRIGGER after_cars_insert
AFTER INSERT
ON cars FOR EACH ROW
BEGIN
    DECLARE rowcount INT;
    UPDATE brands
        SET code = new.car;

END $$

DELIMITER ;




# Creating an After Update Trigger

DELIMITER $$

CREATE OR REPLACE TRIGGER After_t_user_Update

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

CREATE OR REPLACE TRIGGER After_product_archiver_Delete

AFTER DELETE

ON products FOR EACH ROW

BEGIN

	INSERT INTO archived_products 
	(product_id, product_name, cost_price, retail_price, availability) 
		VALUES 
	(OLD.product_id, OLD.product_name, OLD.cost_price, OLD.retail_price, OLD.availability);

END $$

DELIMITER ;




// Creating a After Insert Trigger
//
DELIMITER $$

CREATE OR REPLACE TRIGGER after_deposits_insert
AFTER INSERT
ON deposits FOR EACH ROW
BEGIN
    DECLARE rowcount INT;
    IF new.isuser > 0 THEN
        INSERT INTO userfunds(user_id,bank_id,debit,credit,balance,remarks,created_at,updated_at)
        VALUES(new.user_id,new.bank_id,new.credit,new.debit,
            ((select (case when sum(t1.credit) is null then 0 else sum(t1.credit) end) as amount from userfunds as t1 where t1.user_id = new.user_id) + new.debit),'Balance Credited',NOW(),NOW());
    END IF; 

END $$

DELIMITER ;



DELIMITER $$

CREATE OR REPLACE TRIGGER after_userfunds_insert
AFTER INSERT
ON userfunds FOR EACH ROW
BEGIN
    DECLARE rowcount INT;
    update users set balance = new.balance where id = new.user_id;

END $$

DELIMITER ;



insert into deposits 
(user_id,bank_id,debit,credit,balance,remarks,isuser,created_at) 
values 
(19,8,62,0,101200,'Balance Debited',1)

// Creating a After Insert Trigger
//