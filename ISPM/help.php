<?php

delete from isppackages;

delete from ispnetworks;
delete from ispzones;
delete from ispsubzones;
delete from ispboxes;
delete from ispclients;

delete from ispclientinvoices;
delete from ispclientpayments;


select * from ispnetworks;
select * from ispzones;
select * from ispsubzones;
select * from ispboxes;
select * from ispclients;

select * from isppackages;

select * from ispclientinvoices;
select * from ispclientpayments;



update ispclients set ispnetwork_id = null, ispzone_id = null , ispsubzone_id = null;
update ispboxes set ispnetwork_id = null, ispzone_id = null;
update ispsubzones set ispnetwork_id = null;


update catthirds set catfirst_id = null;
update products set catfirst_id = null, catsecond_id = null;
