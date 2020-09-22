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

//1579647600 ,1584745200 ,1580166000

// 1607986800 ,1612306800 ,1580166000

/*$start   = DateTime::createFromFormat('d-m-Y', '25-12-2013');
$end     = DateTime::createFromFormat('d-m-Y', '26-12-2013');
$dates   = array('24-12-2013','25-12-2013','26-12-2014','31-12-2013');
$matches = array();
foreach ($dates as $date) {
    $date2 = DateTime::createFromFormat('d-m-Y', $date);
    if ($date2 >= $start && $date2 <= $end) {
        $matches[] = $date;
    }
}
print_r($matches);

exit;*/





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


			foreach ($converteddb as $key => $value) {
					$League = $value['League'];
					

					//$Start = DateTime::createFromFormat('d-m-Y', $value["Start"]);
					//$End = DateTime::createFromFormat('d-m-Y', $value["End"]);
					//$argument = DateTime::createFromFormat('d-m-Y', $arg);

					//echo "<pre />";
					//print_r($Start);


			   /* echo $Start = $value["Start"];
			    echo " ,";
			    echo $End = $value["End"];
			    echo " ,";
			    echo $argument = $arg;
					echo "<br />";*/


			    /*echo $Start = substr(trim($value["Start"]),0,5);
			    echo " ,";
			    echo $End = substr(trim($value["End"]),0,5);
			    echo " ,";
			    echo $argument = substr(trim($arg),0,5);
					echo "<br />";
*/

					$Start = strtotime($value["Start"]);
			   
			    $End = strtotime($value["End"]);
	
			    $argument = strtotime($arg);
					


					/*if ($End > $Start) {
						echo "True";
						echo "<br />";
					}else{
						echo "False";
						echo "<br />";
					}*/


			    if($Start <= $argument && $End >= $argument) {
			        echo "Yes $League". "<br />";
			    } else {
			        echo "No " . " $League". "<br />";
			    }
			}



			/*$dates = array("2013-12-24","2013-12-25","2014-12-24","2013-12-27");
			$start = strtotime('2013-12-25');
			$end =   strtotime('2013-12-26');

			foreach($dates AS $date) {
			    $timestamp = strtotime($date);
			    if($timestamp >= $start && $timestamp <= $end) {
			        echo "The date $date is within our date range " . "<br />";
			    } else {
			        echo "The date $date is NOT within our date range " . "<br />";
			    }
			}

			echo "<br />";
			echo "<br />";
			echo "<br />";


			$dates = array("24-12-2013","25-12-2013","24-12-2014","27-12-2013");
			$start = strtotime('25-12-2013');
			$end =   strtotime('26-12-2013');

			foreach($dates AS $date) {
			    $timestamp = strtotime($date);
			    if($timestamp >= $start && $timestamp <= $end) {
			        echo "The date $date is within our date range " . "<br />";
			    } else {
			        echo "The date $date is NOT within our date range " . "<br />";
			    }
			}*/













			//echo "<pre>";
			//print_r($converteddb);


			/*echo "<pre>";
			print_r($database);

			echo "<br />";

			echo "<pre>";
			print_r($converteddb);*/

			/*$str = "22 January";
			$start = strpos($str," ");

			echo $day = substr($str, 0,2);
			echo "<br />";
			echo $month = substr($str, $start);*/

		}
	}




?>