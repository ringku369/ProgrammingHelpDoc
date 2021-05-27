@extends('layouts.master_admin')

@section('title')
  {{"Accounting System :: Report Of Ledgerbook"}}
@endsection


@section('content')

<!-- content part================================ -->

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <p style="visibility: hidden;">BC</p>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('inventory.dashboard') }}"><i class="fa fa-dashboard"></i> Inventory </a></li>
        <li><a href="{{ route('jouraccount.dashboard') }}"><i class="fa fa-dashboard"></i> Accounts </a></li>
        <li><a href="{{ route('hospital.dashboard') }}"><i class="fa fa-dashboard"></i> Hospital </a></li>
        
        
        <li class="active"><a href="{{ route('jourcompany.companyinfo') }}">Company Info</a></li>
        
        <li class="active"><a href="{{ route('jouraccount.chartofaccountstree') }}">Accounts Tree</a></li>
        
        <!-- <li class="active"><a href="{{ route('jouraccount.level1') }}">Level-1</a></li>
        <li class="active"><a href="{{ route('jouraccount.level2') }}">Level-2</a></li>
        <li class="active"><a href="{{ route('jouraccount.level3') }}">level-3</a></li>
        <li class="active"><a href="{{ route('jouraccount.level4') }}">level-4</a></li>
        <li class="active"><a href="{{ route('jouraccount.level5') }}">level-5</a></li> -->

        <li class="active"><a href="{{ route('jouraccount.journal.posting') }}">Journal Entry</a></li>
        <li class="active"><a href="{{ route('jouraccount.journal.journalview') }}">Journal View</a></li>

        <li class="active"><a href="{{ route('jouraccount.reports.trailbalance') }}">Trail Balance</a></li>
        <li class="active"><a href="{{ route('jouraccount.reports.profitandloss') }}">Profit and Loss</a></li>
        <li class="active"><a href="{{ route('jouraccount.reports.balancesheet') }}">Balance Sheet</a></li>
        <li class="active"><a href="{{ route('jouraccount.reports.daybook') }}">Daybook</a></li>
        <li class="active"><a href="{{ route('jouraccount.reports.cashbook') }}">Cashbook</a></li>
        <li class="active"><a href="{{ route('jouraccount.reports.bankbook') }}">Bankbook</a></li>
        <li class="active"><a href="{{ route('jouraccount.reports.ledgerbook') }}">Ledgerbook</a></li>
      </ol>
    </section>







    <!-- Main content -->
    <section class="content">


<!-- Main row -->
<div class="row">
  <!-- Left col -->
  


<!-- ==============one section area ================= -->


  <section class="col-lg-12 connectedSortable">
          <!-- Recent Invoice -->
          <div class="box box-warning">
            <div class="box-header">
              <h3 class="box-title text-danger">Ledgerbook Searching Result According To Voucher Date</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
  
            <!-- form start -->
             <form class="form-horizontal" method="POST" action="{{ route('jouraccount.reports.ledgerbook.store') }} " autocomplete="off" enctype="multipart/form-data">

    @if(count($errors))
      <div class="alert alert-danger alert-dismissible">
        <strong>Whoops!</strong> There were some problems with your input.
        <br/>
        <ul>
          @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if(Session::has('success'))
      

      <div class="alert alert-success alert-dismissible fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> {{Session::get('success')}}
      </div>

    @endif

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
{{-- for for displaying success and errror message --}}
                <div class="box-body">
                


        
  <div class="form-group">
    
    <label class="col-sm-2 control-label">Ledger</label>
    <div class="col-md-5">
      <select name="ledger" id="ledger" class="form-control select2" required="required">
        <option value="">Select Ledger</option>
        @foreach ($jouraccounts as $jouraccount)
          <option value="{{$jouraccount['id']}}">{{$jouraccount['name']}}-{{$jouraccount['code']}}</option>
        @endforeach
      </select>          
    </div>
  </div>
       







                <div class="form-group">
                  <label class="col-sm-2 control-label">Search Date</label>

                  <div class="col-sm-5">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input name="fdate" placeholder="YYYY-MM-DD" value="{{@$retVal = ($ssdata['fdate']) ? $ssdata['fdate'] : ""  }}" type="text" class="form-control pull-right" id="datepicker3"  required="required" autocomplete="off">
                    </div>
                  </div>

                  <div class="col-sm-5">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input name="todate" placeholder="YYYY-MM-DD" value="{{@$retVal = ($ssdata['todate']) ? $ssdata['todate'] : ""  }}" type="text" class="form-control pull-right" id="datepicker4"  required="required" autocomplete="off">
                    </div>
                  </div>
                </div>
                


                </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-success pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            
            </form>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


  </section>

<!-- ==============one section area ================= -->


<style type="text/css">

  #tbtbl table {
    width: 100%;
    border-collapse: collapse;
    
  }

  #tbtbl th{
    padding: 5px;
    border: 1px solid black;
    border-left: none;
    border-right: none;
    border-collapse: collapse;
    font-weight: bold;
    font-size: 13px;
  }


  #tbtbl td {
    border: none;
    font-size: small;
    padding: 5px;
    text-align: left;
    border-collapse: collapse;
    font-size: 12px;
  }

  
  #tbtbl .tfootersucc td{
    border: 1px solid black;
    border-collapse: collapse;
    font-weight: bold;
    font-size: 13px;
  }

  #tbtbl .tfootersucc td{
    border: 1px solid black;
    border-collapse: collapse;
    font-weight: bold;
    font-size: 13px;
  }

  #tbtbl .tfootererr td{
    border: 1px solid black;
    border-collapse: collapse;
    font-weight: bold;
    font-size: 13px;
  }

  #tbtbl .parent td{
    border-collapse: collapse;
    font-weight: bold;
    font-family: serif;
    font-size: 13px;

  }



</style>


<!-- ==============one section area ================= -->
@if (count($ledgerbookdatas) > 0)
  {{-- expr --}}

    



@php
  @$fdate = date_format(date_create($ssdata['fdate']),"Y-m-d");
  @$todate = date_format(date_create($ssdata['todate']),"Y-m-d");
  @$ledger = $ssdata['ledger'];


@endphp


  <section class="col-lg-12 connectedSortable">
          <!-- Recent Invoice -->
          <div class="box box-warning">
            <div class="box-header">
              <!-- <h3 class="box-title">Recent Order Invoice </h3> -->
              <a href="{{ route('jouraccount.reports.ledgerbook.print',[$fdate,$todate,$ledger]) }}" target="_blank" class="btn btn-info btn-xs pull-right">Print Report</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">


    <table id="tbtbl" style="width:100%">
         

    <thead>
      <tr>
        <th colspan="5" style="border: none">
          <caption style="text-align: center;font-size: 12px;font-weight: bold;color: black;">Ledgerbook Report From {{$ssdata['fdate']}} to {{$ssdata['todate']}}</caption>
          <!-- <hr style="padding: 0px;margin-top: -5px; margin-bottom: 8px"> -->
        </th>
      </tr>

  
      <tr>
        <th><span> Date </span></th>
        <th><span> Particulars </span></th>
        <th><span> Voucher Type </span></th>
        <th><span> Voucher No </span></th>
        
        <th><span> Debit </span></th>
        <th><span> Credit </span></th>
      </tr>

    </thead>
<tbody>
  <tr>
    <td> {{$ssdata['fdate']}} {{$requireddata['mode']}}</td>
    <td style="font-weight: bold"> Opening Balance </td>
    <td>  </td>
    <td>  </td>
<td style="font-weight: bold">
  @if ($requireddata['rpmode'] == 'Dr')
    {{number_format($requireddata['opnbalance'],2)}}
  @endif 
</td>
<td style="font-weight: bold">
  @if ($requireddata['rpmode'] == 'Cr')
    {{number_format($requireddata['opnbalance'],2)}}
  @endif
</td>


  @foreach ($ledgerbookdatas as $key => $ledgerbook)


    <tr>
      <td> {{$ledgerbook['date']}} {{$requireddata['mode']}} </td>
      <td> {{$ledgerbook['name']}} </td>
      <td> {{$ledgerbook['vtype']}} </td>
      <td> {{$ledgerbook['vno']}} </td>

<td>
  @if ($requireddata['rpmode'] == 'Dr')
    {{number_format($ledgerbook['balance'],2)}}
  @endif
</td>
<td>
  @if ($requireddata['rpmode'] == 'Cr')
    {{number_format($ledgerbook['balance'],2)}}
  @endif

</td>
    </tr>

  @endforeach


<tr>
  
<td colspan="4"></td>

<td style="font-weight: bold;border-top: 1px solid;">
  @if ($requireddata['rpmode'] == 'Dr')
    {{number_format($requireddata['totalsum'],2)}}
  @endif 
</td>
<td style="font-weight: bold;border-top: 1px solid;">
  @if ($requireddata['rpmode'] == 'Cr')
    {{number_format($requireddata['totalsum'],2)}}
  @endif
</td>

</tr>


<tr>


<td> <span style="visibility: hidden;">{{$ssdata['fdate']}}</span>  {{$requireddata['rpmode']}}</td>
<td style="font-weight: bold"> Closing Balance </td>
<td>  </td>
<td>  </td>


<td style="font-weight: bold;border-bottom: 1px solid;">
  @if ($requireddata['mode'] == 'Dr')
    {{number_format($requireddata['totalsum'],2)}}
  @endif 
</td>
<td style="font-weight: bold;border-bottom: 1px solid;">
  @if ($requireddata['mode'] == 'Cr')
    {{number_format($requireddata['totalsum'],2)}}
  @endif
</td>

</tr>

<tr>
  
<td colspan="4"></td>

<td style="font-weight: bold;border-bottom: 1px solid;">
  {{number_format($requireddata['totalsum'],2)}}
</td>

<td style="font-weight: bold;border-bottom: 1px solid;">
  {{number_format($requireddata['totalsum'],2)}}
</td>

</tr>

</tbody>
  </table>






            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


  </section>
@endif

<!-- ==============one section area ================= -->
























</div>
<!-- /.row (main row) -->
















    </section>
    <!-- /.content -->
 
  </div>
<!-- /.content-wrapper -->





<!-- content part================================ -->
@endsection