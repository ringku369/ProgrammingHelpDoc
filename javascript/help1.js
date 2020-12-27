window.open("http://www.w3schools.com", "_blank");
window.location.href = "http://www.w3schools.com";
window.location.hostname;
window.location.href;

window.open(window.location.href);
location.reload();

window.close();


var currentURL = "https://v2.gcchmc.org/appointment/Ek8NrMgPqzmDK7L/pay/";
var response = currentURL.split("/");
for (x in response) {
  console.log(response[x] + " " + x);
}



$(".class").css("background-color", "yellow");
$("#id").css("background-color", "yellow");
$("input[name='attribute']").css("background-color", "yellow");

$('#upazila1').prop("checked", true);// for radio or checkbox

$('#upazila1').prop("disabled", true);
jQuery("input[type='text']").prop("disabled", true);

$("#id").attr("alt", "Setting New Image");
$( "img" ).attr({
  src: "/images/jquery.gif",
  title: "jQuery Image",
  alt: "Sample jQuery Image"
});

var attrValue = $("#id").attr("alt");

$("table").removeAttr("border");
$("p#pID").hasClass("myClass");
$("p#pID").addClass("myClass");
$("p#pID").removeClass("myClass");
$("p#pID").css("display","none");
$("p#pID").css({
	display: 'block',
	overflow: 'hidden'
});

var title = $("em").attr("title");
$("#divid").text(title);
$("#divid").html(title);


on('click', '.selector', function(event) {
	event.preventDefault();
	/* Act on the event */
});

bind('event name', eventData, function(event) {
	/* Act on the event */
});

$(document.area).bind("mouseover mouseout", ".TextBox11", function (event) {
    console.log(event);
});


$(".container1").find(".debit").each(function() {
  console.log($(this).val());
});


$(document).ready(function() {
  
  $('#level').on('change', function(e){
    var level = e.target.value;
    var route = "{{route('ajax.GetUsersOnLevelChange')}}/"+level;
    $.get(route, function(data) {
      //console.log(data);
      $('#user_id').empty();
      $('#user_id').append('<option value="">Select User</option>');
      $.each(data, function(index,data){
        $('#user_id').append('<option value="' + data.id + '">' + data.firstname + " "+ data.lastname + " ( " +data.email +" ) " +  '</option>');
      });
    });
  });
});


Route::get('/districtSelectBoxOnDivisionWithAjax/{id?}', ['as'=>'admin.districtSelectBoxOnDivisionWithAjax','uses'=>'AdminController@DistrictSelectBoxOnDivisionWithAjax'])->where(['id' => '[0-9]+']);

$('.insert-btn').click(function () {
                
    $(".panel-body :input[type=text]").each(function () {
        var input = $(this);
        var inputval = input.val();

        if (inputval) {
            $(".loading").show();
        } else {
            $(".loading").hide();
            return false;
        }
        console.log(inputval);
    });

    //$('.panel-body').find('input[type=text]').each(function () {
    //    var input = $(this);
    //    console.log(input.val());
    //});
});


var numbers = [65, 44, 12, 4];
var newarray = numbers.map(myFunction)

function myFunction(num) {
  return num * 10;
}

// Output 650,440,120,40




$('#subscribeForm').on('submit',function(event){
  event.preventDefault();


  let url = $(this).attr('action');
  let method = $(this).attr('method');
  let formdata = $(this).serialize();

  //console.log(formdata);

  let success_area = $('.successMsg1');
  let error_area = $('.errorMsg1');
  let submitBtn = $('.submitBtn1');
  let faLoader = $('.faLoader');

  submitBtn.attr({disabled: 'disabled'});
  faLoader.css({display: 'block'});

  $.ajax({
    url: url,
    type:method,
    data:formdata,
    success:function(response){
      faLoader.css({display: 'none'});
      success_area.find('.alert-success').remove();
      error_area.find('.alert-danger').remove();
      submitBtn.removeAttr('disabled');
      success_area.append(
        '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+response.success+'</div>'
        );
      $("#subscribeForm :input[type='text'], :input[type='email'], textarea[name='experience']").val('');

    },
    error: function(xhr,status,error ) {
      faLoader.css({display: 'none'});
      submitBtn.removeAttr('disabled');
      errorMsg(xhr.responseJSON,error_area);
      console.log(xhr);
      console.log(status);
      console.log(error);
    }

  });

  function errorMsg(msg,errorArea){
    success_area.find('.alert-success').remove();
    errorArea.find('.alert-danger').remove();
    for (let index = 0; index < msg.length; index++) {
      const element = msg[index];
      errorArea.append(
        '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+element+'</div>'
      );
    }
  }

});





pcoded-navbar menu-light menupos-static
pcoded-navbar menu-light menupos-static mob-open

pcoded-navbar menu-light menupos-static

pcoded-navbar menu-light menupos-static navbar-collapsed
