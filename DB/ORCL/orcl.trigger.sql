### For printing output
#  Set serveroutput on 


### CREATE_SEQ
#

CREATE SEQUENCE AI_SEQ_TABLENAME START WITH 1;
CREATE SEQUENCE AI_SEQ_TABLENAME START WITH 1 MINVALUE 1 MAXVALUE 100000;


### AUTO_INCREMENT_WITH_SEQ
#

CREATE OR REPLACE TRIGGER TABLENAME_AUTO_INCREMENT 
BEFORE INSERT ON TABLENAME 
FOR EACH ROW

BEGIN
  SELECT AUTO_INCREMENT_SEQ.NEXTVAL INTO   :NEW.ID FROM   dual;
END;


### BEFORE INSERT
#
CREATE OR REPLACE TRIGGER BIN_USERS_TRIGGER
BEFORE INSERT ON USERS FOR EACH ROW

DECLARE username VARCHAR2(128);
BEGIN
  SELECT user INTO username FROM dual;
  DBMS_OUTPUT.PUT_LINE('ONE ROW CHANGES BY : ' || username);
END;



### AFTER INSERT
#
CREATE OR REPLACE TRIGGER AIN_USERS_TRIGGER
AFTER INSERT ON USERS FOR EACH ROW

DECLARE username VARCHAR2(128);
BEGIN
  SELECT user INTO username FROM dual;
  DBMS_OUTPUT.PUT_LINE('ONE ROW CHANGES BY : ' || username);
END;




### BEFORE UPDATE
#
CREATE OR REPLACE TRIGGER BUP_USERS_TRIGGER
BEFORE UPDATE ON USERS FOR EACH ROW

DECLARE username VARCHAR2(128);
BEGIN
  SELECT user INTO username FROM dual;
    IF :NEW.NAME <> :OLD.NAME
    THEN
      INSERT INTO STUDENTS (name) VALUES  (:NEW.NAME);
    END IF;
END;





### AFTER UPDATE
#
CREATE OR REPLACE TRIGGER AUP_USERS_TRIGGER
AFTER UPDATE ON USERS FOR EACH ROW

DECLARE username VARCHAR2(128);
BEGIN
  SELECT user INTO username FROM dual;
    IF :NEW.NAME <> :OLD.NAME
    THEN
      INSERT INTO STUDENTS (name) VALUES  (:NEW.NAME);
    END IF;
END;


### AFTER UPDATE
#
CREATE OR REPLACE TRIGGER AUP_USERS_TRIGGER
AFTER UPDATE ON USERS FOR EACH ROW
BEGIN
    IF :NEW.NAME <> :OLD.NAME
    THEN
        INSERT INTO STUDENTS (name) VALUES  (:OLD.NAME);
    END IF;
END;



### BEFORE DELETE
#
CREATE OR REPLACE TRIGGER BDEL_USERS_TRIGGER
BEFORE DELETE ON USERS FOR EACH ROW
DECLARE username VARCHAR2(128);
BEGIN
  SELECT user INTO username FROM dual;
  DBMS_OUTPUT.PUT_LINE('ONE ROW CHANGES BY : ' || username);
END;


### AFTER DELETE
#
CREATE OR REPLACE TRIGGER ADEL_USERS_TRIGGER
AFTER DELETE ON USERS FOR EACH ROW
DECLARE username VARCHAR2(128);
BEGIN
  SELECT user INTO username FROM dual;
  DBMS_OUTPUT.PUT_LINE('ONE ROW CHANGES BY : ' || username);
END;



### ALL BEFORE TRIGGER
#

CREATE OR REPLACE TRIGGER B_IN_UP_DEL_USERS_TRIGGER
BEFORE INSERT OR UPDATE OR DELETE ON USERS FOR EACH ROW
DECLARE username VARCHAR2(128);
BEGIN
  SELECT user INTO username FROM dual;
  IF INSERTING THEN
    DBMS_OUTPUT.PUT_LINE('ONE ROW INSERTED BY : ' || username);
  ELSIF UPDATING THEN
    DBMS_OUTPUT.PUT_LINE('ONE ROW UPDATED BY : ' || username);
  ELSIF DELETING THEN
    DBMS_OUTPUT.PUT_LINE('ONE ROW DELETED BY : ' || username);
  END IF;
END;



### ALL AFTER TRIGGER
#

CREATE OR REPLACE TRIGGER A_IN_UP_DEL_USERS_TRIGGER
AFTER INSERT OR UPDATE OR DELETE ON USERS FOR EACH ROW
DECLARE username VARCHAR2(128);
BEGIN
  SELECT user INTO username FROM dual;
  IF INSERTING THEN
    DBMS_OUTPUT.PUT_LINE('ONE ROW INSERTED BY : ' || username);
  ELSIF UPDATING THEN
    DBMS_OUTPUT.PUT_LINE('ONE ROW UPDATED BY : ' || username);
  ELSIF DELETING THEN
    DBMS_OUTPUT.PUT_LINE('ONE ROW DELETED BY : ' || username);
  END IF;
END;


#### BEFORE INSERT & UPDATE TRIGGER SAME TABLE UPDATE COLUMN

CREATE OR REPLACE TRIGGER BIN_BUP_CITIES_TRIGGER
BEFORE INSERT OR UPDATE ON CITIES FOR EACH ROW

BEGIN
  IF INSERTING THEN
    :NEW.CODE := TO_CHAR(SYSDATE,'MM') + TO_CHAR(SYSDATE,'YYYY') + AUTO_INCREMENT_SEQ.CURRVAL;
  END IF;

  IF UPDATING THEN
    :NEW.UPDATED_AT := CURRENT_TIMESTAMP;
  END IF;

END;



### citylogs
CREATE TABLE citylogs (
  username VARCHAR(64) NULL,
  city_id NUMBER (4) NOT NULL,
  name VARCHAR(128) NULL,
  code VARCHAR(128) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE OR REPLACE TRIGGER AUP_CITIES_TRIGGER
AFTER UPDATE ON CITIES FOR EACH ROW
DECLARE username VARCHAR2(64);
BEGIN
    IF :NEW.NAME <> :OLD.NAME
    THEN
        INSERT INTO CITYLOGS (city_id,name,code,username) VALUES  (:OLD.ID,:OLD.NAME,:OLD.CODE,username);
    END IF;
END;

### citylogs
#


