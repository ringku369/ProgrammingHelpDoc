<?php

USE vs_acc;

select DISTINCT prefix from cash_voucher_det;

select * from cash_voucher_det where tx_no in (320841,320842,320843)
select * from cash_voucher_det where tx_no in (320841,320842,320843)


select * from cash_voucher_det where tx_no in (326948)

select SUBSTRING(voucher_no1,5,5) from cash_voucher_det where SUBSTRING(voucher_no1,5,5) = '69303';

use vs;
select top 1 * from new_job_cart where job_id = 60606 order by job_id desc;
select top 1 * from payment where tx_no = 70394 order by job_no desc;

