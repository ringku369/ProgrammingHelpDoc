<?php  
	// League 			Start 			End

	// League A 		22 January 		21 March
	// League B 		22 February 	04 April
	// League C 		15 April 		16 June
	// League D 		12 May 			29 July
	// League E 		03 December 	15 January
	// League F 		15 December 	03 February

  	//echo "<br />";
  	//echo $nmonth = date("m", strtotime("February"));


//28-01-2020 League A, League F
//28-01-2040 League A, League F
//15-02-2018 League A

	$classA = new ClassA();

	$classA->datas($arg = "28-01-2020");
	//$classA->datas($arg = "128-01-2040");
	//$classA->datas($arg = "15-02-2018");

	class ClassA
	{
		
		function __construct()
		{
			date_default_timezone_set('Asia/Dhaka');
		}

		function datas($arg = "28-01-2020"){
			
			$year = substr($arg, strrpos(trim($arg),"-") + 1);
			$year1 = substr($arg, strrpos(trim($arg),"-") + 1);

			$day_month = substr(trim($arg),0,5);

			$database = [

				['League' => 'League A', 'Start' => '22 January', 'End' => '21 March'],
				['League' => 'League B', 'Start' => '22 February', 'End' => '04 April'],
				['League' => 'League C', 'Start' => '15 April', 'End' => '16 June'],
				['League' => 'League D', 'Start' => '12 May', 'End' => '29 July'],
				['League' => 'League E', 'Start' => '03 December', 'End' => '15 January'],
				['League' => 'League F', 'Start' => '15 December', 'End' => '03 February']
			];

			

			$converteddb = [];

			foreach ($database as $key => $value) {
				
				$str = $value["Start"];
				$day = substr($str,0,2);
				$month_str = substr($str, strpos($str," "));

				$month = trim(date("m", strtotime($month_str)));


				$str1 = $value["End"];
				$day1 = substr($str1,0,2);
				$month_str1 = substr($str1, strpos($str1," "));

				$month1 = trim(date("m", strtotime($month_str1)));
		

				//$data = $day . "-" . $month . "<br />";

				$League = $value['League'];

				//With Year===
				$Start = $day . "-" . $month . "-" . $year;
				if ($key >= 4) {
					$yearr = (int) $year1 + 1;
					$End = $day1 . "-" . $month1 . "-" . $yearr;
				}else{
					$End = $day1 . "-" . $month1 . "-" . $year;
				}
				//With Year===

				/*//Without Year===
				$Start = $day . "-" . $month;
				$End = $day1 . "-" . $month1;
				//Without Year===*/



				$converteddb[] = [
					'League' => $League, 'Start' => $Start, 'End' => $End
				];


			}


			/*foreach ($converteddb as $key => $value) {
					$League = $value['League'];
					

					$Start = strtotime($value["Start"]);
			   
			    $End = strtotime($value["End"]);
	
			    $argument = strtotime($arg);

			    if($Start <= $argument && $End >= $argument) {
			        echo "Yes $League". "<br />";
			    } else {
			        echo "No " . " $League". "<br />";
			    }
			}*/

			echo "<pre>";
			print_r($database);

			echo "<pre>";
			print_r($converteddb);


			


		}
	}




?>