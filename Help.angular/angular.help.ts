var d1 = new Date();
var year = d1.getFullYear();
var month = d1.getMonth();
var day = d1.getDate();
var c = new Date(year + 1, month, day);
console.log(c);





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


