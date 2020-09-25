<?php 

 //=================================================
    $statement = DB::select("show table status like 'journals'");
    $journal_id = $statement[0]->Auto_increment;
    $vno =  $journal_id + 30 +  date('m') + date('Y');
  //=================================================
