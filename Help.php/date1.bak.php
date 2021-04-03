import { Component, OnInit, Input } from '@angular/core';
import * as moment from 'moment';
import { Router } from '@angular/router';
import { BaseurlService } from 'src/app/services/baseurl.service';
import { AuthService } from 'src/app/services/auth.service';
import { HomeService } from 'src/app/services/home.service';
import { BsDatepickerConfig } from 'ngx-bootstrap/datepicker';
import { HttpClient } from '@angular/common/http';

import { NgxSpinnerService } from 'ngx-spinner';
import { ToastrService } from 'ngx-toastr';

import {NgbModal, ModalDismissReasons, NgbActiveModal} from '@ng-bootstrap/ng-bootstrap';



@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  success =  [];
  errors = [];
  //const timeZoneOffset = new Date().getTimezoneOffset();
  form: any = {
    localDate1 : null,
    localDate : null,
    showlocalDate : null,
    localTimeZone : Intl.DateTimeFormat().resolvedOptions().timeZone
  };

  userForm : any = {
    name : null,
    email : null,
    contact : null,
    note : null,
    dob : null,
    carrier : null,
    iid : null,
    visit : null,
    driving : null,
    schedule_id : null,
    sdate : null
  }

  emptyMessage(): void{
    this.errors = [];
    this.success = [];
  }


  successMsg(msg: any): any{
    // tslint:disable-next-line: prefer-for-of
    for (let index = 0; index < msg.length; index++) {
      const element = msg[index];
      this.toastr.success(element);
    }
  }


  errorMsg(msg: any): any{
    // tslint:disable-next-line: prefer-for-of
    for (let index = 0; index < msg.length; index++) {
      const element = msg[index];
      this.toastr.error(element);
    }
  }

  //public isModal= true;

  public morning:any = [];
  public noon:any = [];
  public evening:any = [];

  public btnDisabled:boolean = true;

  public ModalFormDisplay:boolean = true;
  public ModalSuccessDisplay:boolean = false;

  public showdate:string = ""
  public showtime:string = ""
  public schedule_id:string = "";
  public clearTimeVar:any;
  closeResult = '';

  selectedItems = {};


  @Input() name:any;
  datePickerConfig: Partial<BsDatepickerConfig>;
  datePickerConfigDOB: Partial<BsDatepickerConfig>;

  //public time = new Date();

  constructor(
    private baseurl: BaseurlService,
    private homeservice: HomeService,
    private router: Router,
    private authservice: AuthService,
    private http: HttpClient,
    private spinner: NgxSpinnerService,
    private toastr: ToastrService,
    private modalService: NgbModal
    ) { 
    
    
      this.datePickerConfig = Object.assign({},
      {
        containerClass: 'theme-dark-blue',
        showWeekNumbers: false,
        daysDisabled : [0],
        minDate: new Date(),
        maxDate: new Date(new Date().getFullYear() + 1, new Date().getMonth(), new Date().getDate()),
        dateInputFormat: 'YYYY-MM-DD'
      });

      this.datePickerConfigDOB = Object.assign({},
      {
        containerClass: 'theme-dark-blue',
        showWeekNumbers: false,
        //daysDisabled : [0,6],
        //minDate: new Date(),
        //maxDate: new Date(new Date().getFullYear() + 1, new Date().getMonth(), new Date().getDate()),
        dateInputFormat: 'YYYY-MM-DD'
      });

    }

  
  ngOnInit(): void {
  }

  onDateChange(event:any) {
    this.spinner.show();
    let days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    
    
    this.form.localDate = event.getFullYear() + "-" + ("0" + (event.getMonth() + 1)).slice(-2) + "-" + ("0" + event.getDate()).slice(-2);
    this.form.showlocalDate = days[event.getDay()] + " " +  event.toLocaleString('en-us', { month: 'short' }) + " " +  event.getFullYear();
    
    //this.showdate = days[event.getDay()] + " " +  event.toLocaleString('en-us', { month: 'short' }) + " " +  event.getFullYear();

    this.showdate = (event.getMonth()+1) + "/" + event.getDate() + "/" + event.getFullYear();

    this.showtime = "";

    

    //console.log(this.form.localDate);
    //console.log(this.form.showlocalDate);
    

    this.GetMorningData();
    this.GetNoonData();
    this.GetEveningData();
    //this.spinner.hide();

    //var ddresult = this.calculateDiff(this.form.localDate);

    //console.log(ddresult);


  }


  


  GetMorningData(){
    this.homeservice.postMorningTimeSchedules(this.form).subscribe(
      (response: any) => {
        this.morning = response;
        //console.log(response);
        
        
      },
      (error: any) => {
        //console.log(error.error);
      }
    );
  }


  GetNoonData(){
    this.homeservice.postNoonTimeSchedules(this.form).subscribe(
      (response: any) => {
        this.noon = response;
        //console.log(response);
      },
      (error: any) => {
        //console.log(error.error);
      }
    );
  }

  GetEveningData(){
    this.homeservice.postEveningTimeSchedules(this.form).subscribe(
      (response: any) => {
        this.evening = response;
        this.spinner.hide();
        //console.log(response);
      },
      (error: any) => {
        //console.log(error.error);
        
      }
    );
  }


  isSelectedItem(item:any, id:any) {
    return this.selectedItems[id] && this.selectedItems[id] === item;
  };


  getDifferenceInHours(date1, date2) {
    const diffInMs = Math.abs(date2 - date1);
    return diffInMs / (1000 * 60 * 60);
  }

  calculateDiff(dateSent){
    let currentDate = new Date();
      dateSent = new Date(dateSent);

      //return Math.floor((Date.UTC(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate(), currentDate.getUTCHours(), currentDate.getMonth()) - Date.UTC(dateSent.getFullYear(), dateSent.getMonth(), dateSent.getDate(), dateSent.getUTCHours(), dateSent.getMonth() ) ) /(1000 * 60 * 60));
      return Math.floor
      ( 
        (
          Date.UTC(
              dateSent.getFullYear(), dateSent.getMonth(), dateSent.getDate(), dateSent.getHours(), 
              dateSent.getMinutes() 
            ) 
          - 
          Date.UTC(
            currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate(),
            currentDate.getHours(), currentDate.getMinutes()
          ) 
        ) /(1000 * 60 * 60)
      );
  
    }


  public fromdate = "";
  public Hour = "";
  public Min = "";
  public TFormat = "";

  public Time = "";


  convertTime12to24 (time12h) {
    const [time, modifier] = time12h.split(' ');
  
    let [hours, minutes] = time.split(':');
  
    if (hours === '12') {
      hours = '00';
    }
  
    if (modifier === 'PM') {
      hours = parseInt(hours, 10) + 12;
    }
  
    return `${this.form.localDate} ${hours}:${minutes}`;
  }

  getMorningTime(item:any, id:any){


    // 4 Hours condition
    // var dt = item.name.substring(0, 2) +":"+ item.name.substring(3, 6) +""+ item.name.substring(6, 8).toUpperCase();
    // var TimeResult = this.convertTime12to24(dt);
    // var dateresult = this.calculateDiff(TimeResult);

    // if(dateresult <= 3.9){
    //   this.showtime = null;
    //   this.toastr.error("Sorry you are not eligible for this slot, to get appointments try minimum 4 hours before from your desired slot");
    //   return false;
    // }
    // 4 Hours condition


    this.selectedItems[id] = item;
    this.showtime = item.name;
    this.schedule_id = item.id;
    this.btnDisabled = false;

    



    

  }

  getNoonTime(item:any, id:any){
    // 4 Hours condition
    var dt = item.name.substring(0, 2) +":"+ item.name.substring(3, 6) +""+ item.name.substring(6, 8).toUpperCase();
    var TimeResult = this.convertTime12to24(dt);
    var dateresult = this.calculateDiff(TimeResult);

    if(dateresult <= 3.9){
      this.showtime = null;
      this.toastr.error("Sorry you are not eligible for this slot, to get appointments try minimum 4 hours before from your desired slot");
      return false;
    }
    // 4 Hours condition


    this.selectedItems[id] = item;
    this.showtime = item.name;
    this.schedule_id = item.id;
    this.btnDisabled = false;

    

  }

  getEveningTime(item:any, id:any){
    // this.Hour = item.name.substring(0, 2);
    // this.Min = item.name.substring(3, 6);
    // this.TFormat = item.name.substring(6, 9);

    // this.Time = this.Hour +":"+ this.Min +""+ this.TFormat.toUpperCase();
    // var TimeResult = this.convertTime12to24(this.Time);
    // this.fromdate = this.form.localDate + " "+ TimeResult;
    // var dateresult = this.calculateDiff(this.fromdate);

    // if(dateresult <= 3.9){
    //   this.showtime = null;
    //   this.toastr.error("Sorry you are not eligible for this slot, to get appointments try minimum 4 hours before from your desired slot");
    //   return false;
    // }
    // // 4 Hours condition

    // 4 Hours condition
    var dt = item.name.substring(0, 2) +":"+ item.name.substring(3, 6) +""+ item.name.substring(6, 8).toUpperCase();
    var TimeResult = this.convertTime12to24(dt);
    var dateresult = this.calculateDiff(TimeResult);

    if(dateresult <= 3.9){
      this.showtime = null;
      this.toastr.error("Sorry you are not eligible for this slot, to get appointments try minimum 4 hours before from your desired slot");
      return false;
    }
    // 4 Hours condition
    
    
    this.selectedItems[id] = item;
    this.showtime = item.name;
    this.schedule_id = item.id;
    this.btnDisabled = false;

  }


  onSubmit(): any {


    this.userForm.schedule_id = this.schedule_id;
    this.userForm.sdate = this.form.localDate;

    //console.log(this.userForm);


    this.spinner.show();
    this.homeservice.postBookingDetails(this.userForm).subscribe(
      (response: any) => {
        this.GetMorningData();
        this.GetNoonData();
        this.GetEveningData();
        //this.toastr.success(response.success);
        //this.successMsg(response.success);
        this.spinner.hide();

        this.ModalFormDisplay = false;
        this.ModalSuccessDisplay = true;
        this.setTimeFunction();

      },
      (error: any) => {
        console.log(error);
        this.errorMsg(error.error);
        this.spinner.hide();
        
      }
    );

  }


  // Modal area
  


  modalClose(){
    clearTimeout(this.clearTimeVar);
    this.btnDisabled = true;
    this.userForm = {};
    this.showtime = null;
    this.schedule_id = null;
    this.modalService.dismissAll();
  }



  setTimeFunction() {
    this.clearTimeVar = setTimeout(() => {  
          
      this.btnDisabled = true;
      this.userForm = {};
      this.showtime = null;
      this.schedule_id = null;
      this.modalService.dismissAll();
    
    }, 10000);
    
  }


  openLg(content:any) {

    this.ModalFormDisplay = true;
    this.ModalSuccessDisplay = false;


    this.modalService.open(content, {ariaLabelledBy: 'modal-basic-title', size : 'lg', scrollable: true}).result.then((result) => {
      this.closeResult = `Closed with: ${result}`;
    }, (reason) => {
      this.closeResult = `Dismissed ${this.getDismissReason(reason)}`;
    });

    

  }

  private getDismissReason(reason: any): string {
    if (reason === ModalDismissReasons.ESC) {
      return 'by pressing ESC';
    } else if (reason === ModalDismissReasons.BACKDROP_CLICK) {
      return 'by clicking on a backdrop';
    } else {
      return `with: ${reason}`;
    }
    this.modalClose();
  }

  // Modal area

}
