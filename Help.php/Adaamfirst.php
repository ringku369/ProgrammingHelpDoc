
<!DOCTYPE html>
<html lang="en">
<head>
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-146902071-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-146902071-1');
    </script>


	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<title>GHC</title>
	
		<link rel="stylesheet" href="/static/vendor/semantic/dist/semantic.min.css">

		<!-- Glide.js styles -->
		<link rel="stylesheet" href="/static/css/vendor/glide.core.min.css">
		<link rel="stylesheet" href="/static/css/vendor/glide.theme.min.css">

		<!-- CropperJS styles -->
		<link rel="stylesheet" href="/static/css/vendor/cropper.min.css">

		<!-- Custom styles -->
		<link rel="stylesheet" href="/static/css/main.css">
		<link rel="stylesheet" href="/static/css/instant-notifications.css">

		<!-- Components -->
		<link rel="stylesheet" href="/static/css/components/breadcrumbs.css">
		<link rel="stylesheet" href="/static/css/components/cards.css">
		<link rel="stylesheet" href="/static/css/components/forms.css">
		<link rel="stylesheet" href="/static/css/components/glide.css">
		<link rel="stylesheet" href="/static/css/components/menu.css">
		<link rel="stylesheet" href="/static/css/components/table.css">
		<link rel="stylesheet" href="/static/css/components/message.css">
		<link rel="stylesheet" href="/static/css/components/modal.css">
		<link rel="stylesheet" href="/static/css/components/icons.css">
	
	
</head>
<body>

	
		<div class="ui menu basic borderless gcc-menu">
			
				<div class="ui container">
					<a href="/" class="header item brand">
						<img class="ui image" src="/static/img/gcc-logo.png">
					</a>
					<div class="right menu">
						
						
							<div class="item">
								<a class="ui primary button" href="/login/">Login</a>
							</div>
						
					</div>
				</div>
			
		</div>
	

	
        <div class="ui grid">
            <div class="full wide column">
                <div class="ui menu inverted stackable gcc-submenu">
                    <div class="ui container">
                        



<a class="active-item item" href="/">Home</a>
<a class=" item"
   href="/accreditation/apply/">Apply for GHC accreditation </a>
<a class=" item"
   href="/search-slip/">Print GCC slip</a>
<a class=" item"
   href="/medical-center/search/">Medical centers</a>
<a class=" item"
   href="/medical-status-search/">Check candidate status</a>
<a class=" item"
   href="/contact_us/">Contact us</a>
<a class="item" href="/static/pdf/rules_and_regulations.pdf"
   target="_blank">Rules and regulations</a>
<a class=" item"
   href="/guidelines/">Guidelines</a>



                    </div>
                </div>
            </div>
        </div>
	



	<main class="">
		<div class="ui container content-container">
			<div class="ui breadcrumb">
				
	<a href="/" class="section">Home</a>
	<div class="divider"> /</div>
	<a class="active section">Book an Appointment</a>

			</div>
			
			
    <div class="ui container content-container">
        <h2 class="ui header normal-weight-font lg-header">Register for medical test</h2>
        <div class="ui fluid card gcc-card">
			<div class="content">
	    <form class="ui form booking-appointment-form " method="post" novalidate autocomplete="off">
            <input type="hidden" name="csrfmiddlewaretoken" value="JKAZxJclC2vfmnmLmuslxTsO8lCZFarRAIZOYPr4ahli2nIPhg8TMmtBrZr3cl0D">
            <div class="form-fields-container">
                <h3 class="ui header"><i class="map marker alternate icon"></i>
                    <div class="content md-header">Location</div>
                </h3>
                <div class="field">
                    <div class="two fields">
                        
                        
<div class="field ">
	
		<label>
			Country
			
		</label>
	

	
		<select name="country" required id="id_country">
  <option value="" selected>Select your country</option>

  <option value="BD">Bangladesh</option>

  <option value="EGY">Egypt</option>

  <option value="ETH">Ethiopia</option>

  <option value="GN">Ghana</option>

  <option value="ACT">India</option>

  <option value="IDN">Indonesia</option>

  <option value="IT">Italy</option>

  <option value="JR">Jordan</option>

  <option value="KN">Kenya</option>

  <option value="LB">Lebanon</option>

  <option value="MI">Mali</option>

  <option value="MR">Morocco</option>

  <option value="NEP">Nepal</option>

  <option value="NG">Niger</option>

  <option value="PAK">Pakistan</option>

  <option value="PHL">Philippines</option>

  <option value="PT">Portugal</option>

  <option value="Sri">Srilanka</option>

  <option value="SUD">Sudan</option>

  <option value="TNZ">Tanzania</option>

  <option value="THI">Thailand</option>

  <option value="TUR">Turkey</option>

  <option value="UG">Uganda</option>

</select>
	
	
	
		
	
</div>

                        
                        
<div class="field ">
	
		<label>
			City
			
		</label>
	

	
		<select name="city" required id="id_city">
  <option value="" selected>Select your city</option>

</select>
	
	
	
		
	
</div>

                    </div>
                </div>
                <div class="field">
                    <div class="two fields">
                        
                        
<div class="field ">
	
		<label>
			Country Traveling To
			
		</label>
	

	
		<select name="traveled_country" required id="id_traveled_country">
  <option value="" selected>Select GCC country</option>

  <option value="BH">Bahrain</option>

  <option value="KW">Kuwait</option>

  <option value="OM">Oman</option>

  <option value="QA">Qatar</option>

  <option value="SA">Saudi Arabia</option>

  <option value="UAE">UAE</option>

  <option value="YEM">Yemen</option>

</select>
	
	
	
		
	
</div>

                        <div class="field medical-center-field medical-center-field-js">
                            
                            
<div class="field ">
	
		<label>
			Medical Center
			
		</label>
	

	
		<select name="medical_center" id="id_medical_center">
  <option value="" selected>Select Medical Center</option>

</select>
	
	
	
		
	
</div>

                        </div>
                    </div>
                </div>
                <div class="ui section divider"></div>
                <h3 class="ui header"><i class="user icon"></i>
                    <div class="content md-header">Candidate&#39;s information</div>
                </h3>
                <div class="field">
                    <div class="two fields">
                        
                        
<div class="field ">
	
		<label>
			First Name
			
		</label>
	

	
		<input type="text" name="first_name" placeholder="Abdulaziz" maxlength="50" required id="id_first_name">
	
	
	
		
	
</div>

                        
                        
<div class="field ">
	
		<label>
			Last Name
			
		</label>
	

	
		<input type="text" name="last_name" placeholder="Asfour" maxlength="50" required id="id_last_name">
	
	
	
		
	
</div>

                    </div>
                </div>
                <div class="field">
                    <div class="two fields">
                        
                        
<div class="field ">
	
		<label>
			Date of Birth
			
		</label>
	

	
		<div class="ui calendar calendar-js">
    <div class="ui input right icon">
        <i class="calendar alternate outline icon"></i>
        <input type="text" name="dob" placeholder="Select Date" required id="id_dob">


    </div>
</div>
	
	
	
		
	
</div>

                        
                        
<div class="field ">
	
		<label>
			Nationality
			
		</label>
	

	
		<select name="nationality" required id="id_nationality">
  <option  value="" selected>Select Nationality</option>

  <option  value="1012">Algeria</option>

  <option  value="1008">American</option>

  <option  value="1036">Armenian</option>

  <option  value="1031">Australian</option>

  <option  value="14">Bahraini</option>

  <option  value="15">Bangladeshi</option>

  <option  value="1016">Belarusian</option>

  <option  value="1034">Brazilian</option>

  <option  value="1014">Britain</option>

  <option  value="30">Burkinabe</option>

  <option  value="32">Burundian</option>

  <option  value="1017">canadian</option>

  <option  value="40">Chinese</option>

  <option  value="1022">Dutch</option>

  <option data-required="True" value="55">Egyptian</option>

  <option  value="58">Eritrean</option>

  <option  value="60">Ethiopian</option>

  <option  value="177">Filipino</option>

  <option  value="1024">French</option>

  <option  value="1018">german</option>

  <option  value="69">Ghanaian</option>

  <option  value="74">GuineanGuyanese</option>

  <option  value="1">Indian</option>

  <option  value="81">Indonesian</option>

  <option  value="1009">Iraqi</option>

  <option  value="84">Irish</option>

  <option  value="1035">Italian</option>

  <option  value="87">Ivorian</option>

  <option  value="90">Jordanian</option>

  <option  value="92">Kenyan</option>

  <option  value="94">Kuwaiti</option>

  <option  value="98">Lebanese</option>

  <option  value="1028">Libyan</option>

  <option  value="105">Malagasy</option>

  <option  value="1015">Malaysia</option>

  <option  value="109">Malian</option>

  <option  value="119">Moroccan</option>

  <option  value="125">Nepalese</option>

  <option  value="130">Nigerian</option>

  <option  value="134">Omani</option>

  <option  value="135">Pakistani</option>

  <option  value="1007">palestine</option>

  <option  value="1032">Portuguese</option>

  <option  value="1033">Portuguese</option>

  <option  value="144">Qatari</option>

  <option  value="1021">Russian</option>

  <option  value="148">Saudi</option>

  <option  value="1030">somali</option>

  <option  value="1011">South Africa</option>

  <option  value="156">Sri Lankan</option>

  <option  value="157">Sudanese</option>

  <option  value="160">Syrian</option>

  <option  value="163">Tanzanian</option>

  <option  value="164">Thai</option>

  <option  value="194">TUNISIAN</option>

  <option  value="165">Turkish</option>

  <option  value="166">Ugandan</option>

  <option  value="1013">United states of America</option>

  <option  value="171">Vietnamese</option>

  <option  value="172">YEMENI</option>

</select>
	
	
	
		
	
</div>

                    </div>
                </div>
                <div class="field">
                    <div class="two fields">
                        
                        
<div class="field inline inline-radio">
	
		<label>
			Gender
			
		</label>
	

	
		<ul id="id_gender">
    <li><label for="id_gender_0"><input type="radio" name="gender" value="male" required id="id_gender_0">
 Male</label>

</li>
    <li><label for="id_gender_1"><input type="radio" name="gender" value="female" required id="id_gender_1">
 Female</label>

</li>
</ul>
	
	
	
		
	
</div>

                        
                        
<div class="field inline inline-radio">
	
		<label>
			Marital status
			
		</label>
	

	
		<ul id="id_marital_status">
    <li><label for="id_marital_status_0"><input type="radio" name="marital_status" value="married" required id="id_marital_status_0">
 Married</label>

</li>
    <li><label for="id_marital_status_1"><input type="radio" name="marital_status" value="unmarried" required id="id_marital_status_1">
 Single</label>

</li>
</ul>
	
	
	
		
	
</div>

                    </div>
                </div>
                <div class="field">
                    <div class="two fields">
                        
                        
<div class="field ">
	
		<label>
			Passport №
			
		</label>
	

	
		<input type="text" name="passport" maxlength="50" required id="id_passport">
	
	
	
		
	
</div>

                        
                        
<div class="field ">
	
		<label>
			Confirm Passport №
			
		</label>
	

	
		<input type="text" name="confirm_passport" maxlength="50" required id="id_confirm_passport">
	
	
	
		
	
</div>

                    </div>
                </div>
                <div class="field">
                    <div class="two fields">
                        
                        
<div class="field ">
	
		<label>
			Passport Issue Date
			
		</label>
	

	
		<div class="ui calendar calendar-js">
    <div class="ui input right icon">
        <i class="calendar alternate outline icon"></i>
        <input type="text" name="passport_issue_date" placeholder="Select Date" required id="id_passport_issue_date">


    </div>
</div>
	
	
	
		
	
</div>

                        
                        
<div class="field ">
	
		<label>
			Passport Issue Place
			
		</label>
	

	
		<input type="text" name="passport_issue_place" maxlength="50" required id="id_passport_issue_place">
	
	
	
		
	
</div>

                        
                    </div>
                </div>
                <div class="field">
                    <div class="two fields">
                        
                        
<div class="field ">
	
		<label>
			Passport Expiry Date
			
		</label>
	

	
		<div class="ui calendar calendar-js">
    <div class="ui input right icon">
        <i class="calendar alternate outline icon"></i>
        <input type="text" name="passport_expiry_on" placeholder="Select Date" required id="id_passport_expiry_on">


    </div>
</div>
	
	
	
		
	
</div>

                        
                        
<div class="field ">
	
		<label>
			Visa Type
			
		</label>
	

	
		<select name="visa_type" required id="id_visa_type">
  <option value="" selected>Select Visa Type</option>

  <option value="wv">Work Visa</option>

  <option value="fv">Family Visa</option>

</select>
	
	
	
		
	
</div>

                        
                    </div>
                </div>
                <div class="field">
                    <div class="two fields">
                        
                        
<div class="field ">
	
		<label>
			Email ID
			
		</label>
	

	
		<input type="email" name="email" required id="id_email">
	
	
	
		
	
</div>

                        
                        
<div class="field ">
	
		<label>
			Phone №
			
		</label>
	

	
		<input type="text" name="phone" placeholder="+9612345678922" maxlength="14" required id="id_phone">
	
	
	
		
	
</div>

                    </div>
                </div>
                <div class="field">
                    <div class="two fields">
                        
                        
<div class="field ">
	
		<label>
			National ID
			
				<span class="optional">Optional</span>
			
		</label>
	

	
		<input type="text" name="national_id" maxlength="50" id="id_national_id">
	
	
	
		
	
</div>

                        
                    </div>
                </div>
                <div class="two fields">
                    
<div class="field ">
	
		<label>
			Position applied for
			
		</label>
	

	
		<select name="applied_position" id="id_applied_position">
  <option value="" selected>---------</option>

  <option value="18">Banking &amp; Finance</option>

  <option value="19">Carpenter</option>

  <option value="20">Cashier</option>

  <option value="21">Electrician</option>

  <option value="22">Engineer</option>

  <option value="23">General Secretory</option>

  <option value="24">Health &amp; Medicine &amp; Nursing</option>

  <option value="25">Heavy Driver</option>

  <option value="26">IT &amp; Internet Engineer</option>

  <option value="27">Leisure &amp; Tourism</option>

  <option value="28">Light Driver</option>

  <option value="29">Mason</option>

  <option value="30">President</option>

  <option value="31">Labour</option>

  <option value="32">Plumber</option>

  <option value="33">Doctor</option>

  <option value="34">Family</option>

  <option value="35">Steel Fixer</option>

  <option value="36">Aluminum Technician</option>

  <option value="37">Nurse</option>

  <option value="38">Male Nurse</option>

  <option value="39">Ward Boy</option>

  <option value="40">Shovel Operator</option>

  <option value="41">Dozer Operator</option>

  <option value="42">Car Mechanic</option>

  <option value="43">Petrol Mechanic</option>

  <option value="44">Diesel Mechanic</option>

  <option value="45">Student</option>

  <option value="46">Accountant</option>

  <option value="47">Lab Technician</option>

  <option value="48">Drafts man</option>

  <option value="49">Auto-Cad Operator</option>

  <option value="50">Painter</option>

  <option value="51">Tailor</option>

  <option value="52">Welder</option>

  <option value="53">X-ray Technician</option>

  <option value="54">Lecturer</option>

  <option value="55">A.C Technician</option>

  <option value="56">Business</option>

  <option value="57">Cleaner</option>

  <option value="58">Security Guard</option>

  <option value="59">House Maid</option>

  <option value="60">Manager</option>

  <option value="61">Hospital Cleaning</option>

  <option value="62">Mechanic</option>

  <option value="63">Computer Operator</option>

  <option value="64">House Driver</option>

  <option value="65">Driver</option>

  <option value="66">Cleaning Labour</option>

  <option value="67">Building Electrician</option>

  <option value="68">Salesman</option>

  <option value="69">Plastermason</option>

  <option value="70">Servant</option>

  <option value="71">Barber</option>

  <option value="72">Residence</option>

  <option value="73">Shepherds</option>

  <option value="74">Employment</option>

  <option value="75">Fuel Filler</option>

  <option value="76">Worker</option>

  <option value="77">House Boy</option>

  <option value="78">House Wife</option>

  <option value="79">RCC Fitter</option>

  <option value="80">Clerk</option>

  <option value="81">Microbiologist</option>

  <option value="82">Teacher</option>

  <option value="83">Helper</option>

  <option value="84">Hajj Duty</option>

  <option value="85">Shuttering</option>

  <option value="86">Supervisor</option>

  <option value="87">Medical Specialist</option>

  <option value="88">Office Secretary</option>

  <option value="89">Technician</option>

  <option value="90">Butcher</option>

  <option value="91">Arabic Food Cook</option>

  <option value="92">Agricultural Worker</option>

  <option value="93">Service</option>

  <option value="94">Studio CAD Designer</option>

  <option value="95">Financial Analyst</option>

  <option value="96">Cabin Appearance (AIR LINES)</option>

  <option value="97">Car Washer</option>

  <option value="98">Surveyor</option>

  <option value="99">Electrical Technician</option>

  <option value="100">Waiter</option>

</select>
	
	
	
		
	
</div>

                    <div class="field ">
                        <label>Other</label>
                        <div class="inline fields">
                            <input type="checkbox" name="applied_position_is_other"
                                   id="id_applied_position_is_other" >&nbsp;
                            <input type="text" name="applied_position_other" maxlength="128"
                                   id="id_applied_position_other" value="">
                        </div>
                        
                    </div>
                </div>
                <div class="ui section divider"></div>
                <div class="field">
                    <div class="two fields">
                        
<div class="field ">
	

	
		<div class="captcha-container ui icon input"><img src="/captcha/image/26d3730c11df79ea013e32802cb28fc7d670f361/" alt="captcha" class="captcha"/><input type="hidden" name="captcha_0" value="26d3730c11df79ea013e32802cb28fc7d670f361" placeholder="Enter Code" required id="id_captcha_0"><input type="text" name="captcha_1" placeholder="Enter Code" required id="id_captcha_1" autocapitalize="off" autocomplete="off" autocorrect="off" spellcheck="false"><i class="sync alternate icon link captcha-refresh"></i></div>
	
	
	
		
	
</div>

                    </div>
                </div>
                <div class="field">
                    <div class="field ui checkbox agree-checkbox inline reverse">
                        <input type="checkbox" name="confirm" required="" id="id_confirm">
                        <label>I confirm that the information given in this from is true, complete and accurate</label>
                    </div>
                </div>
                
            </div>
            <div class="form-buttons-container">
                <button class="ui primary large submit right floated button" type="submit">Submit</button>
            </div>
        </form>
			</div>
      </div>
    </div>

		</div>
	</main>



	<div class="ui vertical basic segment footer">
		<div class="ui container center aligned">
			<div class="copyright">© 2019 Gulf Health Council. All rights reserved</div>
			
		</div>
	</div>



<script src="/static/jsi18n/en/djangojs.js"></script>
<script src="/static/vendor/jquery.min.js"></script>
<script src="/static/vendor/semantic/dist/semantic.min.js"></script>
<script src="/static/js/vendor/cropper.min.js"></script>
<script src="/static/js/vendor/jquery-cropper.min.js"></script>
<script src="/static/js/vendor/glide.min.js"></script>
<script src="/static/js/vendor/js.cookie.js"></script>
<script src="/static/js/main.js"></script>
<script src="/static/js/table-config.js"></script>

<script>
  $(document).ready(function() {
    $('.ui.dropdown').dropdown();
    $('.ui.dropdown.item').dropdown({on: 'hover'});
    $('.ui.checkbox').checkbox();
    $('.message .close')
      .on('click', function() {
        $(this)
          .closest('.message')
          .transition('fade');
      });
  });

</script>


    
<link href="/static/vendor/semantic-ui-calendar/calendar.min.css" type="text/css" media="all" rel="stylesheet">
<link href="/static/css/components/captcha.css" type="text/css" media="all" rel="stylesheet">
<link href="/static/css/booking-appointment-form.css" type="text/css" media="all" rel="stylesheet">
<script type="text/javascript" src="/static/vendor/semantic-ui-calendar/calendar.min.js"></script>
<script type="text/javascript" src="/static/js/calendar-widget.js"></script>
<script type="text/javascript" src="/static/js/captcha.js"></script>
<script type="text/javascript" src="/static/vendor/state-machine/state-machine.min.js"></script>
<script type="text/javascript" src="/static/js/vendor/moment.js"></script>
<script type="text/javascript" src="/static/js/booking-appointment-form.js"></script>

</body>
</html>
