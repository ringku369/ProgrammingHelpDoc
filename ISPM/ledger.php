<?php

  public function LedgerbookView(){
    if (Auth::user()->level != 500) { return redirect()->route('logout');}

//Session::forget(['ledger','fdate','todate']);
//dd(self::$accsetting_array);
    $JouraccountCount = Jouraccount::where(['accsetting_id'=>self::$accsetting_id,'whereto'=>0])->where('groupby','!=',1)->count();
    $JouraccountResult = Jouraccount::where(['accsetting_id'=>self::$accsetting_id,'whereto'=>0])->where('groupby','!=',1)->orderBy('id','asc')->get();
    $jouraccounts = $JouraccountResult->toArray();

//========ledgerbook report===============
    $ssdata = [];
    $ledgerbookdatas = [];
    $requireddata = [];

    if (Session::get('ledger') && Session::get('fdate') && Session::get('todate')) {
      $ledger = Session::get('ledger');
      $fdate = Session::get('fdate');
      $todate = Session::get('todate');
      $ssdata = ['ledger'=>$ledger,'fdate'=>$fdate, 'todate' => $todate];
  

//--------- new code --------

$count = Accpreaccdata::where(['accsetting_id'=>self::$accsetting_id, 'id' => $ledger])->count();

if ($count > 0) {
  
  $query = DB::table('accpreaccdatas as t1')
    ->select(
        't1.id','t1.name',
        DB::raw('(CASE WHEN t1.gid1 = 1 THEN "Dr" WHEN t1.gid1 = 2 THEN "Cr" WHEN t1.gid1 = 3 THEN "Cr" ELSE "Dr" END) AS rmode'),
        DB::raw('(CASE WHEN t1.gid1 = 1 THEN "Cr" WHEN t1.gid1 = 2 THEN "Dr" WHEN t1.gid1 = 3 THEN "Dr" ELSE "Cr" END) AS mode'),
        DB::raw('(CASE WHEN t1.gid1 = 1 THEN t1.opnbdebit WHEN t1.gid1 = 2 THEN t1.opnbcredit WHEN t1.gid1 = 3 THEN t1.opnbcredit ELSE t1.opnbdebit END) AS incbalance')
      )
    ->where(['accsetting_id'=>self::$accsetting_id, 'id' => $ledger])
    ->first();
  $queryresults = json_decode(json_encode($query), True);



} else {
  
  $query = DB::table('jouraccounts as t1')
    ->select(
        't1.id','t1.name',
        DB::raw('(CASE WHEN t1.gid1 = 1 THEN "Dr" WHEN t1.gid1 = 2 THEN "Cr" WHEN t1.gid1 = 3 THEN "Cr" ELSE "Dr" END) AS rmode'),
        DB::raw('(CASE WHEN t1.gid1 = 1 THEN "Cr" WHEN t1.gid1 = 2 THEN "Dr" WHEN t1.gid1 = 3 THEN "Dr" ELSE "Cr" END) AS mode'),
        DB::raw('(CASE WHEN t1.gid1 = 1 THEN t1.opnbdebit WHEN t1.gid1 = 2 THEN t1.opnbcredit WHEN t1.gid1 = 3 THEN t1.opnbcredit ELSE t1.opnbdebit END) AS incbalance')
      )
    ->where(['accsetting_id'=>self::$accsetting_id, 'id' => $ledger])
    ->first();
  $queryresults = json_decode(json_encode($query), True);

}



//-------------------------------------------------------------



$jouraccount_id = $queryresults['id'];
$rmode = $queryresults['rmode'];
$mode = $queryresults['mode'];
$incbalance = $queryresults['incbalance'];

//---------------------------------
$query = DB::table('jourposts')
  ->select('id','vdate')
  ->where(['accsetting_id'=>self::$accsetting_id])
  ->orderBy('id','asc')
  ->first();
$queryresults = json_decode(json_encode($query), True);
$ind  = $queryresults['vdate'];

$bdate = date('Y-m-d', strtotime('-1 day', strtotime($fdate)));
//---------------------------------





$query = DB::table('jourposts as t1')
  ->select(
DB::raw('(CASE WHEN t1.gid1 = 1 THEN SUM(t1.debit) WHEN t1.gid1 = 2 THEN SUM(t1.credit) WHEN t1.gid1 = 3 THEN SUM(t1.credit) ELSE SUM(t1.debit) END) AS opnbalance')
  )
  ->where(['t1.accsetting_id'=>self::$accsetting_id, 't1.jouraccount_id' => $ledger])
  ->whereBetween(DB::raw("DATE_FORMAT(t1.vdate,'%Y-%m-%d')"), [$ind,$bdate])
  ->first();
$openigResult = json_decode(json_encode($query), True);




$query = DB::table('journals as t1')
  ->select(
    DB::raw('(CASE WHEN t2.gid1 = 1 THEN SUM(t2.debit) WHEN t2.gid1 = 2 THEN SUM(t2.credit) WHEN t2.gid1 = 3 THEN SUM(t2.credit) ELSE SUM(t2.debit) END) AS clbbalance')
  )
  ->join('jourposts as t2','t2.journal_id','=','t1.id')
  ->where(['t1.accsetting_id'=>self::$accsetting_id, 't2.jouraccount_id' => $ledger])
  ->whereBetween(DB::raw("DATE_FORMAT(t1.vdate,'%Y-%m-%d')"), [$fdate, $todate])
  //->groupby('t2.vdate')
  ->orderBy('t1.id','asc')
  ->first();
$closingResult = json_decode(json_encode($query), True);


$requireddata['rpmode'] = $rmode;
$requireddata['mode'] = $mode;
$requireddata['opnbalance'] = $openigResult['opnbalance'] + $incbalance;

$requireddata['clbbalance'] = $closingResult['clbbalance'];
$requireddata['totalsum'] = $openigResult['opnbalance'] + $incbalance + $closingResult['clbbalance'];


//dd($requireddata);

//-------------------------------------------------------------


$query = DB::table('journals as t1')
  ->select(
    't1.vdate','t1.vno','t1.id',
    't2.jouraccount_id',
    DB::raw('(CASE WHEN t1.vtype = 1 THEN "Payment" WHEN t1.vtype = 2 THEN "Receipt"  WHEN t1.vtype = 3 THEN "Journal" ELSE "Contra" END) AS vtype, (CASE WHEN t1.rpmode = 1 THEN "Cash" WHEN t1.rpmode = 2 THEN "Bank" WHEN t1.rpmode = 3 THEN "Cash" ELSE "Others" END) AS rpmode, DATE_FORMAT(t1.vdate,"%D %b %y") as date'),
    DB::raw('(CASE WHEN t2.gid1 = 1 THEN SUM(t2.debit) WHEN t2.gid1 = 2 THEN SUM(t2.credit) WHEN t2.gid1 = 3 THEN SUM(t2.credit) ELSE SUM(t2.debit) END) AS balance'),

    DB::raw('(CASE WHEN t1.rpmode = 1 THEN 
      (SELECT name FROM jourposts WHERE journal_id = t1.id AND rpmode = 1 LIMIT 1)
       WHEN t1.rpmode = 2 THEN 
       (SELECT name FROM jourposts WHERE journal_id = t1.id AND rpmode = 2 LIMIT 1) 
       WHEN t1.rpmode = 3 THEN 
       (SELECT name FROM jourposts WHERE journal_id = t1.id AND rpmode = 1 LIMIT 1) ELSE "Others" END) AS name'
     )
  )
  ->join('jourposts as t2','t2.journal_id','=','t1.id')
  ->where(['t1.accsetting_id'=>self::$accsetting_id, 't2.jouraccount_id' => $ledger])
  ->whereBetween(DB::raw("DATE_FORMAT(t1.vdate,'%Y-%m-%d')"), [$fdate, $todate])
  ->groupby('t2.vdate')
  ->orderBy('t1.id','asc')
  ->get();

$ledgerbookdatas = json_decode(json_encode($query), True);


//dd($ledgerbookdatas);



//--------- new code --------


//Session::forget(['ledger','fdate','todate']);


  }


  return view('admin.jouraccount.ledgerbook',['accsetting_array'=>self::$accsetting_array,'ssdata'=>$ssdata,'ledgerbookdatas'=>$ledgerbookdatas,'requireddata' => $requireddata, 'jouraccounts' => $jouraccounts]);


}

