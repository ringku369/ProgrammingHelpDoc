<?php

use ispm;



truncate table isppackages;

truncate table ispnetworks;
truncate table ispzones;
truncate table ispsubzones;
truncate table ispboxes;
truncate table ispclients;

truncate table ispclientinvoices;
truncate table ispclientpayments;


truncate table catfirsts;
truncate table catseconds;
truncate table catthirds;

truncate table products;

truncate table productsummaries;

truncate table purchases;
truncate table purchasedetails;

truncate table sales;
truncate table saledetails;



delete from isppackages;

delete from ispnetworks;
delete from ispzones;
delete from ispsubzones;
delete from ispboxes;
delete from ispclients;

delete from ispclientinvoices;
delete from ispclientpayments;


delete table catfirsts;
delete table catseconds;
delete table catthirds;

delete table products;

delete table productsummaries;

delete table purchases;
delete table purchasedetails;

delete table sales;
delete table saledetails;


select * from ispnetworks;
select * from ispzones;
select * from ispsubzones;
select * from ispboxes;
select * from isppackages;

select * from ispclients;
select * from ispclientinvoices;
select * from ispclientpayments;

select * from users;




select * from  catfirsts;
select * from  catseconds;
select * from  catthirds;

select * from  products;

select * from  productsummaries;

select * from  purchases;
select * from  purchasedetails;

select * from  sales;
select * from  saledetails;





update ispclients set ispnetwork_id = null, ispzone_id = null , ispsubzone_id = null;
update ispboxes set ispnetwork_id = null, ispzone_id = null;
update ispsubzones set ispnetwork_id = null;


update catthirds set catfirst_id = null;
update products set catfirst_id = null, catsecond_id = null;

from ispclients as t1 
join isppackages as t2 on t2.id = t1.isppackage_id
