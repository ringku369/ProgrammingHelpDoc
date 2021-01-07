$returndata = ["Password has been changed successfully"];
return response()->json($returndata, 200,[],JSON_PRETTY_PRINT);

$returndata = ["Something went wrong"];
return response()->json($returndata, 400,[],JSON_PRETTY_PRINT);



$rules  =  array(
  'username' => 'required',
  'password' => 'required|min:1|max:50'
);

$validator = Validator::make( $request->all(),$rules);

if ($validator->fails())
{
  $messages = $validator->errors();
  return response()->json($messages->all(),400,[],JSON_PRETTY_PRINT);
}



//this.spinner.show();
this.form.localDate = event.getFullYear() + "-" + (event.getMonth()+1) + "-" + event.getDate();
//this.form.localTime = event.getHours() + ":" + event.getMinutes() + ":" + event.getSeconds();
//this.form.localTime = this.formatAMPM(event);
//console.log(this.form);
//console.log(event.getFullYear() + "-" + event.getMonth() + "-" + event.getDate() );

//console.log(event.getHours() + "." + event.getMinutes() + "." + event.getSeconds() );
//console.log(event.toLocaleString('en-US', { hour: 'numeric', hour12: true }) );
//console.log(this.formatAMPM(event) );

formatAMPM(date:any) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
  }


MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=linkbrt@gmail.com
MAIL_PASSWORD=ytluvqcqautuooed
MAIL_ENCRYPTION=tls


import { NgxSpinnerModule } from 'ngx-spinner';

schemas: [
    CUSTOM_ELEMENTS_SCHEMA
  ],


import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { AuthtokenService } from '../../services/authtoken.service';

import { from } from 'rxjs';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';
import { AuthGuard } from 'src/app/services/auth.guard';
import { AuthstatusService } from 'src/app/services/authstatus.service';
import { NgxSpinnerService } from 'ngx-spinner';
import { ToastrService } from 'ngx-toastr';


private authservice: AuthService,
private authtoken: AuthtokenService,
private router: Router,
private authstatus: AuthstatusService,
private spinner: NgxSpinnerService,
private toastr: ToastrService






<!-- ngx-spinner Area -->
	<ngx-spinner></ngx-spinner>
<!-- ngx-spinner Area -->



<!-- ngx-spinner Area -->

<div class="col-md-12" style="margin-top: -40px;">
  <!-- <ngx-spinner bdOpacity="0" bdColor="" padding="0px" size="small" color="#581f87" type="line-scale-party"
    [fullScreen]="false">
  </ngx-spinner> -->

  <ngx-spinner bdColor="rgba(51,51,51,0.8)" size="medium" color="#fff" type="ball-scale-multiple">
    <p style="font-size: 20px; color: white">Loading...</p>
  </ngx-spinner>

  <!-- <ngx-spinner bdColor = "rgba(0, 0, 0, 0.8)" size = "medium" color = "#fff" type = "square-jelly-box" [fullScreen] = "false"><p style="color: white;" > Loading... </p></ngx-spinner> -->
  <!-- <ngx-spinner bdColor="rgba(51,51,51,0.8)" size="medium" color="#fff" type="ball-scale-multiple">
    <p style="font-size: 20px; color: white">Loading...</p>
  </ngx-spinner> -->

</div>

<!-- ngx-spinner Area -->


<div class="row">
  <ngx-spinner></ngx-spinner>
  <div class="col-sm-12">
    <app-card cardTitle="Hello Card">
      <p class="text-center text-danger text-bold m-t-20">This is admin settings</p>
      <p class="p-t-20">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
      <button class="btn btn-primary btn-md" (click)="btnOpen()"> Toaster Open</button>
      <button class="btn btn-primary btn-md" (click)="btnClose()"> Toaster Close</button>
    </app-card>
  </div>
</div>



